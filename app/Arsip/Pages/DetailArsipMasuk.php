<?php

namespace App\Arsip\Pages;

use App\Models\ArsipMasuk;
use App\Models\BiodataPegawai;
use App\Models\KlasifikasiSurat;
use App\Models\SettingCatatanDisposisi;
use App\Models\SettingKopSurat;
use App\Traits\CetakDokumen;
use App\Traits\Fonnte;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DetailArsipMasuk extends Component
{
    use WithFileUploads, CetakDokumen, Fonnte;
    public $arsipMasuk;
    public $createdAt;

    #[Validate('required|mimes:pdf|max:2048')]
    public $berkasUpload;

    public $catatan = [];
    public $waTerkirim = false;

    public $tanggalSurat, $asalSurat, $perihal, $klasifikasi;

    public function mount($arsipMasukId){
        $this->arsipMasuk = ArsipMasuk::find($arsipMasukId);
        $this->createdAt = Carbon::parse($this->arsipMasuk->created_at);

        if($this->arsipMasuk->status > 0){
            $this->fillCatatan(json_decode($this->arsipMasuk->catatan));
        }

        //edit detail
        $this->tanggalSurat = $this->arsipMasuk->tanggal_surat;
        $this->asalSurat = $this->arsipMasuk->asal_surat;
        $this->perihal = $this->arsipMasuk->perihal;
        $this->klasifikasi = $this->arsipMasuk->klasifikasi->kode;
    }

    public function render()
    {
        $listKlasifikasi = [];
        if($this->klasifikasi != null){
            $listKlasifikasi = KlasifikasiSurat::whereAny(['kode', 'klasifikasi'], "LIKE", "%".$this->klasifikasi."%")->get();
        }
        return view('arsip.pages.detail-arsip-masuk', compact('listKlasifikasi'));
    }

    public function uploadBerkas(){
        $this->validate();

        $tanggal = Carbon::parse($this->arsipMasuk->created_at);
        $this->berkasUpload->storeAs(path: "/public/arsip/".$tanggal->year."/surat-masuk/".$tanggal->locale('id')->translatedFormat("F"), name: $this->arsipMasuk->id.".pdf");

        if($this->arsipMasuk->status < 1){
            $this->arsipMasuk->update([
                'status' => 1
            ]);
        }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Surat Masuk Tersimpan."
        ]);

        $this->dispatch('close-modal', ['modalName' => "modalUploadArsip"]);
    }

    public function fillCatatan($catatans){
        if($catatans != null){
            foreach($catatans as $catatan){
                $this->catatan[] = SettingCatatanDisposisi::find($catatan);
            }
        }
    }

    public function loadCetakDisposisiContent($arsipMasukId){
        $arsipMasuk = ArsipMasuk::find($arsipMasukId);
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection("H")->generate("http://e-letter.sman3pekalongan.sch.id/detail-disposisi-kepsek/"));
        $data = [
            'kopSurat' => SettingKopSurat::first(),
            'qrcode' => $qrcode,
            'arsipMasuk' => $arsipMasuk
        ];

        return $data;
    }

    public function kirimUlangDisposisi(){
        $linkDisposisi  = config('app.url')."/disposisi-kepsek/".$this->arsipMasuk->id;
        $bulanDiterima = Carbon::parse($this->arsipMasuk->created_at)->locale('id')->translatedFormat("F");
        $tahunDiterima = Carbon::parse($this->arsipMasuk->created_at)->format("Y");
        $linkDownload = config('app.url')."/storage/arsip/".$tahunDiterima."/surat-masuk/".$bulanDiterima."/".$this->arsipMasuk->id.".pdf";
        $pesan = "*SURAT MASUK* (".Carbon::parse($this->arsipMasuk->tanggal_diterima)->format("d/m/Y").")

Asal Surat : ".$this->arsipMasuk->asal_surat."
Perihal : ".$this->arsipMasuk->perihal."

*Link Disposisi* :
".$linkDisposisi."

                    ";
        // *Download Surat* :
        // ".$linkDownload."
        $this->kirimDisposisiKepsek($pesan);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Disposisi Terkirim."
        ]);
    }

    public function cetak($arsipMasukId){
        $dt = $this->loadCetakDisposisiContent($arsipMasukId);
        $data = array('data' => $dt, 'arsipMasuk' => $dt['arsipMasuk']);
        return $this->cetakDokumenLandscape('arsip.cetak.disposisi', $data , $dt['arsipMasuk']->id.'.pdf');
    }

    public function saveDisposisi($arsipMasukId){
        $dt = $this->loadCetakDisposisiContent($arsipMasukId);
        $arsipMasuk = $dt['arsipMasuk'];
        $date = Carbon::parse($arsipMasuk->created_at);
        $data = array('data' => $dt, 'arsipMasuk' => $dt['arsipMasuk']);
        $saveLocation = storage_path("app/public/arsip/".$date->format("Y")."/surat-masuk/".$date->locale('id')->translatedFormat("F")."/".$arsipMasuk->id."_disposisi.pdf");
        $this->simpanDokumenLandscape('arsip.cetak.disposisi', $data, $saveLocation);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Disposisi Tersimpan."
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

    public function hapusArsip(){
        $this->arsipMasuk->update([
            'status' => 9
        ]);
        $this->dispatch('close-modal', ["modalName" => "modalKonfirmasiHapusArsip"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Surat masuk dihapus sebagai arsip."
        ]);
    }

    public function restoreArsip(){
        $this->arsipMasuk->update([
            'status' => 0
        ]);
        $this->dispatch('close-modal', ["modalName" => "modalKonfirmasiRestoreArsip"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Surat masuk diproses ulang."
        ]);
    }

    public function simpanDetailSuratMasuk(){
        if(in_array(null, [$this->tanggalSurat, $this->asalSurat, $this->perihal, $this->klasifikasi])){
           return throw ValidationException::withMessages(['klasifikasi' => "Lengkapi form !"]);
        }

        $kodeKlasifikasi = trim(explode("-", $this->klasifikasi)[0]);
        $klasifikasi = KlasifikasiSurat::where('kode', $kodeKlasifikasi)->get()->first();

        $this->arsipMasuk->update([
            'tanggal_surat' => $this->tanggalSurat,
            'asal_surat' => $this->asalSurat,
            'perihal' => $this->perihal,
            'nomor_klasifikasi' => $klasifikasi->id
        ]);

        $this->dispatch('close-modal', ["modalName" => "modalEditDetail"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Update berhasil."
        ]);

        $this->reset(['tanggalSurat', 'asalSurat', 'perihal', 'klasifikasi']);
    }
}
