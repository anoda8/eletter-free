<?php

namespace App\Mobile\Pages;

use App\Models\ArsipMasuk;
use App\Models\BiodataPegawai;
use App\Models\DisposisiArsipMasuk;
use App\Models\JabatanPegawai;
use App\Models\ReferensiSekolah;
use App\Models\SettingCatatanDisposisi;
use App\Models\SettingJabatan;
use App\Models\SettingKopSurat;
use App\Traits\Fonnte;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DisposisiKepsek extends Component
{
    use Fonnte;

    public $suratMasuk;
    public $bulanFile;

    public $listJabatan = [], $listCatatan = [];

    #[Validate('required')]
    public $sifatSurat;

    //disposisi
    #[Validate('required')]
    public $disposisiKe = [];

    public $tambahanDisposisiKe = [], $cariTambahanDisposisiKe, $foundTambahanDisposisiKe = [];

    //Catatan
    #[Validate('required')]
    public $catatan = [];

    public $tambahanCatatan;

    //SuratTugas
    public $suratTugas = [], $cariSuratTugas, $foundSuratTugas = [];

    //TargetSelesai
    public $targetSelesai;

    public $pesanTerkirim = [];

    public $allowed = false;

    public function mount($suratMasukId){
        $this->suratMasuk = ArsipMasuk::find($suratMasukId);
        $this->bulanFile = \Carbon\Carbon::parse($this->suratMasuk->created_at)->format("m");
        $this->listJabatan = SettingJabatan::with(['jabatanPegawai'])->where('tampil_disposisi', 1)->orderBy('sort', 'ASC')->get();
        $this->listCatatan = SettingCatatanDisposisi::all();
        $this->targetSelesai = $this->suratMasuk->tanggal_target_selesai;
        if(request()->segment(1) == "disposisi-kepsek"){
            $this->allowed = true;
        }else{
            if(($this->suratMasuk->status > 0) && Auth::check()){
                $this->cekDisposisiUser();
            }
        }
    }

    #[Layout('layouts.mobile')]
    public function render()
    {
        if($this->cariTambahanDisposisiKe != null){
            $this->foundTambahanDisposisiKe = BiodataPegawai::where('nama', 'like', "%".$this->cariTambahanDisposisiKe."%")->get()->take(3);
        }

        if($this->cariSuratTugas != null){
            $this->foundSuratTugas = BiodataPegawai::where('nama', 'like', "%".$this->cariSuratTugas."%")->get()->take(3);
        }
        return view('mobile.pages.disposisi-kepsek');
    }

    public function ubahSifatSurat($sifat){
        $this->sifatSurat = $sifat;
    }

    public function addTambahanDisposisi($pegawaiId){
        array_push($this->tambahanDisposisiKe, $pegawaiId);
        $this->reset(['foundTambahanDisposisiKe', 'cariTambahanDisposisiKe']);
    }

    public function removeTambahanDisposisi($pegawaiId){
        foreach ($this->tambahanDisposisiKe as $key => $pegawai) {
            if($pegawaiId === $pegawai){
                unset($this->tambahanDisposisiKe[$key]);
            }
        }
    }

    public function addTambahanSurgas($pegawaiId){
        array_push($this->suratTugas, $pegawaiId);
        $this->reset(['foundSuratTugas', 'cariSuratTugas']);
    }

    public function removeTambahanSurgas($pegawaiId){
        foreach ($this->suratTugas as $key => $pegawai) {
            if($pegawaiId === $pegawai){
                unset($this->suratTugas[$key]);
            }
        }
    }

    public function simpanKirimDisposisi(){
        $this->validate();

        $referensiSekolah = ReferensiSekolah::first();

        $linkDisposisi = config('app.url')."/disposisi-pegawai-view/".$this->suratMasuk->id;
        $pesan = "*DISPOSISI KEPALA ".strtoupper($referensiSekolah->nama)."*

Asal Surat  : ".$this->suratMasuk->asal_surat."
Perihal     : ".$this->suratMasuk->perihal."

*Detail Surat* :
".$linkDisposisi."

        ";


        foreach ($this->disposisiKe as $key => $dsp) {

            $jabatanPegawai = JabatanPegawai::find($dsp);

            $dspArsipMasuk = DisposisiArsipMasuk::create([
                'arsip_masuk_id' => $this->suratMasuk->id,
                'biodata_pegawai_id' => $jabatanPegawai->pegawai->id,
                'jabatan_pegawai_id' => $jabatanPegawai->jabatan->id,
            ]);

            if($jabatanPegawai->pegawai->nomor_hp != null){
                $kirimPesan = $this->sendMessage($jabatanPegawai->pegawai->nomor_hp, $pesan, 'disposisi');
                if($kirimPesan['data']->status == true){
                    array_push($this->pesanTerkirim, $jabatanPegawai->pegawai->nama);
                    $dspArsipMasuk->update([
                        'terkirim' => date("Y-m-d H:i:s")
                    ]);
                }
            }

            $dspArsipMasuk = null;
        }

        if(count($this->tambahanDisposisiKe) > 0){
            foreach ($this->tambahanDisposisiKe as $key => $dsp) {

                $bioPegawai = BiodataPegawai::find($dsp);

                $dspArsipMasuk = DisposisiArsipMasuk::create([
                    'arsip_masuk_id' => $this->suratMasuk->id,
                    'biodata_pegawai_id' => $dsp,
                ]);

                if($bioPegawai->nomor_hp !== null){
                    $kirimPesan = $this->sendMessage($bioPegawai->nomor_hp, $pesan, 'disposisi');
                    if($kirimPesan['data']->status == true){
                        array_push($this->pesanTerkirim, $bioPegawai->nama);
                        $dspArsipMasuk->update([
                            'terkirim' => date("Y-m-d H:i:s")
                        ]);
                    }
                }

                $dspArsipMasuk = null;

            }

        }

        $data['pesan-terkirim'] = $this->pesanTerkirim;
        $data['surat']['asal-surat'] = $this->suratMasuk->asal_surat;
        $data['surat']['perihal'] = $this->suratMasuk->perihal;

        $this->suratMasuk->update([
            'sifat_surat' => $this->sifatSurat,
            'catatan' => json_encode($this->catatan),
            'catatan_tambahan' => $this->tambahanCatatan,
            'tanggal_target_selesai' => $this->targetSelesai,
            'status' => 1
        ]);

        redirect('/disposisi-kepsek-terkirim')->with('data', $data);
    }

    public function cekDisposisiUser(){
        $pegawai = BiodataPegawai::where('user_id', auth()->user()->id)->get()->first();
        if($pegawai == null){
            return;
        }
        foreach ($this->suratMasuk->disposisi as $key => $dsp) {
            if($dsp->biodata_pegawai_id == $pegawai->id){
                if($dsp->diterima == null){
                    DisposisiArsipMasuk::find($dsp->id)->update([
                        'diterima' => date("Y-m-d H:i:s")
                    ]);

                    $this->dispatch('show-alert', [
                        'icon' => 'success', 'message' => "Surat masuk dibaca."
                    ]);
                }
            }
        }
    }

}
