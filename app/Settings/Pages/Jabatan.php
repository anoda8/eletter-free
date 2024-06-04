<?php

namespace App\Settings\Pages;

use App\Models\BiodataPegawai;
use App\Models\JabatanPegawai;
use App\Models\SettingJabatan;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Jabatan extends Component
{
    public $tampilDisposisi = true;

    public $jumlahJabatan;
    public $urutanTerpilih;
    public $urutan;

    #[Validate('required')]
    public $namaJabatan, $pegawai;

    public $listPegawai, $pegawaiSelected;

    public function render()
    {
        if(($this->pegawai != null) && ($this->pegawaiSelected == null)){
            $this->listPegawai = BiodataPegawai::where('nama', 'like', '%'.$this->pegawai.'%')->get()->take(3);
        }

        if($this->pegawaiSelected != null){
            $this->pegawai = $this->pegawaiSelected->nama;
        }
        return view('settings.pages.jabatan');
    }

    public function simpanJabatan(){
        $this->validate();
        $maxUrut = SettingJabatan::max('sort');
        $maxUrut = $maxUrut == null ? 0 : $maxUrut;

        $settingJabatan = SettingJabatan::create([
            'nama_jabatan' => $this->namaJabatan,
            'tampil_disposisi' => $this->tampilDisposisi,
            'sort' => $maxUrut + 1
        ]);

        JabatanPegawai::create([
            'biodata_pegawai_id' => $this->pegawaiSelected->id,
            'setting_jabatan_id' => $settingJabatan->id
        ]);

        $this->reset(['namaJabatan', 'tampilDisposisi', 'pegawaiSelected', 'listPegawai', 'pegawai']);
        $this->dispatch('refreshDatatable');
        $this->dispatch('close-modal', ['modalName' => "modalTambahJabatan"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Tersimpan."
        ]);
    }

    #[On('show-ganti-urutan')]
    public function showGantiUrutan($urutanId){
        $this->jumlahJabatan = SettingJabatan::all()->count();
        $this->urutanTerpilih = SettingJabatan::find($urutanId)->first()->sort;
    }

    public function deleteRecord($jabatanId){
        SettingJabatan::find($jabatanId)->delete();
        JabatanPegawai::where('setting_jabatan_id', $jabatanId)->delete();
        return redirect('/settings/jabatan');
    }

    public function pilihPegawai($pegawaiId){
        $this->pegawaiSelected = BiodataPegawai::find($pegawaiId);
        $this->reset(['listPegawai']);
    }

    public function simpanUrutan(){

    }
}
