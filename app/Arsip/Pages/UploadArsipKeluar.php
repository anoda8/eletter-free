<?php

namespace App\Arsip\Pages;

use App\Models\ArsipKeluar;
use App\Models\ArsipKeluarFile;
use App\Models\KlasifikasiSurat;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadArsipKeluar extends Component
{
    use WithFileUploads;

    public bool $apaUnggahBerkas = false;
    public bool $notifKepsek = false;
    public bool $kirimDrafKepsek = false;
    public String $unggahBerkasSebagai;

    public bool $filledkodeKlasifikasi = false;

    #[Validate('required')]
    public $perihal, $kodeKlasifikasi, $tanggalSurat;

    public $klasifikasi;
    public $kepadaYth;

    #[Validate('required_if:unggahBerkasSebagai,arsip')]
    public $fileArsip;

    #[Validate('required_if:unggahBerkasSebagai,draf')]
    public $fileDraf;

    public $tipeBerkas, $lampiran;


    public function mount(){

    }

    public function render()
    {
        $listKlasifikasi = [];
        if(($this->kodeKlasifikasi != null) && ($this->filledkodeKlasifikasi == false)){
            $listKlasifikasi = KlasifikasiSurat::where('kode', 'like', "%".$this->kodeKlasifikasi."%")->orWhere('klasifikasi', 'like', "%".$this->kodeKlasifikasi."%")->get();
        }
        return view('arsip.pages.upload-arsip-keluar', compact('listKlasifikasi'));
    }

    public function simpanSuratKeluar(){
        $this->validate();
        $kodeKlasifikasi = KlasifikasiSurat::where('kode', $this->kodeKlasifikasi);
        // dd($kodeKlasifikasi);
        if(!$kodeKlasifikasi->exists()){
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Kode klasifikasi tidak ditemukan"
            ]);
            return;
        }

        $data = [
            'user_id' => auth()->user()->id,
            'nomor_agenda' => '-',
            'nomor_klasifikasi' => $kodeKlasifikasi->first()->id,
            'kepada_yth' => $this->kepadaYth,
            'tanggal_surat' => $this->tanggalSurat,
            'status' => 0,
            'tahun' => date("Y"),
            'perihal' => $this->perihal
        ];

        $arsipKeluar = ArsipKeluar::create($data);

        if ($this->apaUnggahBerkas) {
            if($this->uploadArsip($arsipKeluar->id)){
                $this->dispatch('show-alert', [
                    'icon' => 'success', 'message' => "File Terupload"
                ]);
                return redirect('/arsip/arsip-keluar');
            }
        }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Surat Keluar tersimpan."
        ]);

        return redirect('/arsip/arsip-keluar');
    }

    public function uploadArsip($arsipKeluarId) : bool{
        $date = \Carbon\Carbon::now()->locale('id');

        $data = [
            'arsip_keluar_id' => $arsipKeluarId,
            'mode_berkas' => $this->unggahBerkasSebagai,
            'lampiran' => $this->lampiran,
        ];

        ArsipKeluarFile::create($data);

        if ($this->unggahBerkasSebagai == 'draf') {
            $this->fileDraf->storeAs(path: 'public/draf/'.$date->format('Y').'/surat-keluar/'.$date->translatedFormat('F').'/', name: $arsipKeluarId.".pdf");
            return true;
        }

        if ($this->unggahBerkasSebagai == 'arsip') {
            $this->fileArsip->storeAs(path: 'public/arsip/'.$date->format('Y').'/surat-keluar/'.$date->translatedFormat('F').'/', name: $arsipKeluarId.".pdf");
            return true;
        }

        return false;
    }

    public function updatedKodeKlasifikasi($val){
        $this->kodeKlasifikasi = trim(explode("-", $this->kodeKlasifikasi)[0]);
        $this->klasifikasi = $val;
    }
}
