<?php

namespace App\Databases\Pages;

use App\Models\BiodataPegawai;
use App\Models\JabatanPegawai;
use App\Models\SettingJabatan;
use App\Traits\OnlineData;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BiodataPegawaiView extends Component
{
    use OnlineData;

    public $pegawai, $jabatan;

    public $nama, $tanggalLahir, $nik, $nuptk, $nip, $pendidikanTerakhir, $golonganTerakhir;

    public $listPangkatGolongan = [];

    #[Validate('required')]
    public $nomorHp;

    public $gelarDepan, $gelarBelakang, $jabatanDitambahkan;

    public function mount($pegawaiId){
        $this->pegawai = BiodataPegawai::find($pegawaiId);
        $this->jabatan = SettingJabatan::all();
        $this->nama = $this->pegawai->nama;
        $this->tanggalLahir = $this->pegawai->tanggal_lahir ;
        $this->nik = $this->pegawai->nik ;
        $this->nuptk = $this->pegawai->nuptk ;
        $this->nip = $this->pegawai->nip ;
        $this->pendidikanTerakhir = $this->pegawai->pendidikan_terakhir ;
        $this->golonganTerakhir = $this->pegawai->pangkat_golongan_terakhir;
        $this->gelarDepan = $this->pegawai->gelar_depan ;
        $this->gelarBelakang = $this->pegawai->gelar_belakang ;
        $this->nomorHp = $this->pegawai->nomor_hp ;

        $this->listPangkatGolongan = $this->getPangkatGolongan();
    }

    public function render()
    {
        $jabatanPegawai = JabatanPegawai::with(['pegawai'])->where('biodata_pegawai_id', $this->pegawai->id)->get();
        return view('databases.pages.biodata-pegawai-view', compact('jabatanPegawai'));
    }

    public function simpanBiodataPegawai(){
        $this->validate();
        $this->pegawai->update([
            'gelar_depan' => $this->gelarDepan,
            'gelar_belakang' => $this->gelarBelakang,
            'nomor_hp' => $this->filterNoHp($this->nomorHp),
            'pangkat_golongan_terakhir' => $this->golonganTerakhir
        ]);

        if ($this->jabatanDitambahkan != null) {
            JabatanPegawai::updateOrCreate([
                'biodata_pegawai_id' => $this->pegawai->id,
                'setting_jabatan_id' => $this->jabatanDitambahkan
            ], [
                'biodata_pegawai_id' => $this->pegawai->id,
                'setting_jabatan_id' => $this->jabatanDitambahkan
            ]);
        }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Data pegawai tersimpan."
        ]);
    }

    public function hapusJabatan($jbtnPgId){
        $jbtn = JabatanPegawai::find($jbtnPgId);
        if($jbtn){
            $jbtn->delete();
        }
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Jabatan dihapus."
        ]);
    }

    public function filterNoHp($noHp){
        $plus62 = str_replace("+62", "0", $noHp);
        $spasi = str_replace(" ", "", $plus62);
        $strip = str_replace("-", "", $spasi);
        return $strip;
    }
}
