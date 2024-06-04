<?php

namespace App\Arsip\Pages;

use App\Models\ArsipKeluar as ModelsArsipKeluar;
use App\Models\KlasifikasiSurat;
use App\Models\SettingAplikasi;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ArsipKeluar extends Component
{
    public $reqSuratKeluar;

    public $surkelHapus;

    public $surkelProses = null;

    public $nomorAgendaDibuat;

    public $loggedInUser;

    #[Validate('required')]
    public $klasifikasi, $perihal, $tanggalSurat;

    public $suratKeluarEdit;

    public function mount(){
        $this->loggedInUser = auth()->user();
    }

    public function render()
    {
        $listKlasifikasi = [];
        $this->reqSuratKeluar = ModelsArsipKeluar::with(['file'])->where('nomor_agenda', '-')->get();
        if($this->klasifikasi != null){
            $listKlasifikasi = KlasifikasiSurat::whereAny(['klasifikasi', 'kode'], 'LIKE', "%".$this->klasifikasi."%")->get();
        }
        return view('arsip.pages.arsip-keluar', compact('listKlasifikasi'));
    }

    public function setNomorSurkel(){
        if($this->surkelProses != null){

            $nomorAgendaBaru = $this->getNomorAgenda();

            $this->surkelProses->update([
                'nomor_agenda' => $nomorAgendaBaru,
                'status' => 1
            ]);

            $this->dispatch('refreshDatatable');

            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Nomor Agenda baru dibuat."
            ]);

            return;
        }
        $this->dispatch('show-alert', [
            'icon' => 'error', 'message' => "Gagal membuat nomor agenda baru."
        ]);
    }

    public function pilihRequestSurkel($surkelId){
        $this->suratKeluarEdit = ModelsArsipKeluar::find($surkelId);
        $this->klasifikasi = $this->suratKeluarEdit->klasifikasi->kode;
        $this->perihal = $this->suratKeluarEdit->perihal;
        $this->tanggalSurat = $this->suratKeluarEdit->tanggal_surat;
    }

    public function simpanEditedSuratKeluar(){
        $nomorKlasifikasi = trim(explode("-", $this->klasifikasi)[0]);
        $klasifikasi = KlasifikasiSurat::where('kode', $nomorKlasifikasi)->get()->first();
        $this->suratKeluarEdit?->update([
            'perihal' => $this->perihal,
            'tanggal_surat' => $this->tanggalSurat,
            'nomor_klasifikasi' => $klasifikasi->id
        ]);

        $this->dispatch('close-modal', ['modalName' => "modalEditSurkel"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Permintaan surat keluar tersimpan."
        ]);
        $this->reset(['klasifikasi', 'perihal', 'tanggalSurat']);
    }

    public function konfHapusSurkel($surkelId){
        $this->surkelHapus = ModelsArsipKeluar::find($surkelId);
    }

    public function prosesSurkel($surkelId){
        $this->surkelProses = ModelsArsipKeluar::with(['klasifikasi'])->find($surkelId);
    }

    public function getNomorAgenda(){
        $max = ModelsArsipKeluar::where('tahun', date("Y"))->whereNot('nomor_agenda', '-')->max('nomor_agenda');

        //cek setting max
        $setting = SettingAplikasi::first();
        $noAwal = $setting->aplikasi_noawal_arsipkeluar;

        if($noAwal != null){
            if($max < $noAwal){
                return $noAwal;
            }
        }

        if($max == '-'){return "001";}
        $max = (integer)$max + 1;
        if(strlen($max) == 1){return "00".$max;}
        if(strlen($max) == 2){return "0".$max;}
        return $max;
    }

    public function hapusSurkel(){
        if($this->surkelHapus != null){
            $this->surkelHapus->delete();
            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Terhapus."
            ]);
        }
        $this->dispatch('close-modal', ['modalName' => "konfirmasiHapusSurkel"]);
    }

    public function clearProsesSurkel(){
        $this->surkelProses = null;
    }
}
