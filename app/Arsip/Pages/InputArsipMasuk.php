<?php

namespace App\Arsip\Pages;

use App\Models\ArsipMasuk;
use App\Models\BiodataPegawai;
use App\Models\DataInstansi;
use App\Models\FileArsipMasuk;
use App\Models\KlasifikasiSurat;
use App\Models\SettingAplikasi;
use App\Traits\Fonnte;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;

class InputArsipMasuk extends Component
{
    use Fonnte;

    public $fileMasuk;

    // #[Session]
    public $arsipMasuk = null;

    #[Validate('required')]
    public $nomorAgenda, $asalSurat, $perihal, $nomorSurat, $nomorKlasifikasi, $tanggalSurat, $tanggalDiterima;

    public $targetSelesai;

    public $kirimWaKepsek, $waTerkirim = false;

    public $filledAsalSurat = false;
    public $filledNomorKlasifikasi = false;

    public function mount($fileMasukId){
        $this->fileMasuk = FileArsipMasuk::find($fileMasukId);
        if($this->fileMasuk->terarsip == 1){
            return redirect('/arsip/arsip-masuk')->with('kesalahan', "Surat Masuk sudah diarsipkan.");
        }
        $this->nomorAgenda = $this->arsipMasuk != null ? $this->arsipMasuk->nomor_agenda : $this->getNomorAgenda();
        $this->perihal = $this->arsipMasuk != null ?  $this->arsipMasuk->perihal : $this->fileMasuk->perihal;
        $this->kirimWaKepsek = true;
        $this->asalSurat = $this->arsipMasuk != null ? $this->arsipMasuk->asal_surat : '';
        $this->nomorSurat = $this->arsipMasuk != null ? $this->arsipMasuk->nomor_surat : '';
        $this->nomorKlasifikasi = $this->arsipMasuk != null ? $this->arsipMasuk->nomor_klasifikasi : '';
        $this->tanggalSurat = $this->arsipMasuk != null ? $this->arsipMasuk->tanggal_surat : '';
        $this->targetSelesai = $this->arsipMasuk != null ? $this->arsipMasuk->tanggal_target_selesai : '';
        $this->tanggalDiterima = date("Y-m-d");
    }

    public function render()
    {
        $listInstansi = $listKlasifikasi = [];
        if(($this->asalSurat != null) && ($this->filledAsalSurat == false)){
            $listInstansi = DataInstansi::where('nama_instansi', 'like', "%".$this->asalSurat."%")->get();
        }
        if(($this->nomorKlasifikasi != null) && ($this->filledNomorKlasifikasi == false)){
            $listKlasifikasi = KlasifikasiSurat::where('kode', 'like', "%".$this->nomorKlasifikasi."%")->orWhere('klasifikasi', 'like', "%".$this->nomorKlasifikasi."%")->get();
        }
        return view('arsip.pages.input-arsip-masuk', compact('listInstansi', 'listKlasifikasi'));
    }

    public function simpanArsipMasuk(){
        // dd($this->targetSelesai);
        $this->validate();
        $nomorKlasifikasi = KlasifikasiSurat::where('kode', $this->nomorKlasifikasi)->get();
        if($nomorKlasifikasi->count() == 0){
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Nomor klasifikasi tidak ditemukan."
            ]);
            return;
        }
        // dd($nomorKlasifikasi);

        $data = [
            'user_id' => auth()->user()->id,
            'nomor_agenda' => $this->nomorAgenda,
            'asal_surat' => $this->asalSurat,
            'perihal' => $this->perihal,
            'nomor_surat' => $this->nomorSurat,
            'nomor_klasifikasi' => $nomorKlasifikasi->first()->id,
            'tanggal_surat' => $this->tanggalSurat,
            'tanggal_diterima' => $this->tanggalDiterima,
            'tanggal_target_selesai' => $this->targetSelesai == "" ? null : $this->targetSelesai,
            'tahun' => date("Y")
        ];

        if($this->arsipMasuk != null){
            $this->arsipMasuk->update($data);
            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Surat masuk tersimpan."
            ]);
            return;
        }

        $arsipMasuk = ArsipMasuk::create($data);

        $this->fileMasuk->update([
            'terarsip' => 1,
            'arsip_masuk_id' => $arsipMasuk->id
        ]);

        $bulanDiterima = Carbon::parse($arsipMasuk->created_at)->locale('id')->translatedFormat("F");
        $tahunDiterima = Carbon::parse($arsipMasuk->created_at)->format("Y");
        Storage::disk('public')->move('uploads/'.$this->fileMasuk->id.".pdf", 'arsip/'.$tahunDiterima."/surat-masuk/".$bulanDiterima."/".$arsipMasuk->id.".pdf");

        $linkDisposisi  = config('app.url')."/disposisi-kepsek/".$arsipMasuk->id;
        $linkDownload   = config('app.url')."/storage/arsip/".$tahunDiterima."/surat-masuk/".$bulanDiterima."/".$arsipMasuk->id.".pdf";

        if($this->kirimWaKepsek == true){
            $pesan = "*SURAT MASUK* (".Carbon::parse($this->tanggalDiterima)->format("d/m/Y").")

Asal Surat : ".$this->asalSurat."
Perihal : ".$this->perihal."

*Link Disposisi* :
".$linkDisposisi."

            ";
            // *Download Surat* :
            // ".$linkDownload."
            $this->kirimDisposisiKepsek($pesan);
        }

        $this->arsipMasuk = $arsipMasuk;
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Surat masuk tersimpan."
        ]);
    }

    public function kirimDisposisiKepsek($pesan){
        $fails = true;
        $kepsek = BiodataPegawai::where('jenis_ptk_id_str', "Kepala Sekolah")->get();
        // dd($kepsek);
        if($kepsek !== null){
            if($kepsek->first() !== null){
                $this->dispatch('show-alert', [
                    'icon' => 'error', 'message' => "Nomor HP Kepala Sekolah belum terisi."
                ]);
                $fails = false;
            }
        }


        if(!$fails){
            $nomorKepsek = $kepsek->first()->nomor_hp;
            $kirimPesan = $this->sendMessage($nomorKepsek, $pesan, 'disposisi');
            if($kirimPesan != false){
                // dd($kirimPesan);
                $this->waTerkirim = true;
            }
        }
    }

    public function simpanInstansi(){
        DataInstansi::create(['nama_instansi' => $this->asalSurat]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Instansi tersimpan."
        ]);
    }

    public function getNomorAgenda(){
        $max = ArsipMasuk::where('tahun', date("Y"))->max('nomor_agenda');

        //cek setting max
        $setting = SettingAplikasi::first();
        $noAwal = $setting->aplikasi_noawal_arsipmasuk;

        if($noAwal != null){
            if($max < $noAwal){
                return $noAwal;
            }
        }

        //normal
        if($max == null){return "001";}
        $max = (integer)$max + 1;
        if(strlen($max) == 1){return "00".$max;}
        if(strlen($max) == 2){return "0".$max;}
        return $max;
    }

    public function updatedNomorKlasifikasi(){
        $this->nomorKlasifikasi = trim(explode("-", $this->nomorKlasifikasi)[0]);
    }
}
