<?php

namespace App\Settings\Pages;

use App\Models\ReferensiGtk;
use App\Models\ReferensiKepangkatan;
use App\Models\ReferensiPendFormal;
use App\Models\ReferensiSekolah;
use App\Models\ReferensiSiswa;
use App\Models\SettingKopSurat;
use Livewire\Component;
use App\Traits\Dapodik;

class SinkronisasiDapodik extends Component
{
    use Dapodik;
    public $statusKoneksi = false;
    public $dtSekolah, $dtGtk, $dtSiswa;

    public function render()
    {
        if(is_object($this->dataSekolah())){
            $this->statusKoneksi = true;
        }
        return view('settings.pages.sinkronisasi-dapodik');
    }

    public function cekDtSekolah(){
        $this->dtSekolah = $this->dataSekolah();
    }

    public function cekDtGtk(){
        $this->dtGtk = $this->dataDapodik('getGtk');
    }

    public function cekDtSiswa(){
        $this->dtSiswa = $this->dataDapodik('getPesertaDidik');
    }

    public function syncDtSekolah(){
        $cek = ReferensiSekolah::first();
        if($cek != null){
            ReferensiSekolah::where('id', $cek->id)->update(
                (array)$this->dtSekolah->rows
            );
        }else{
            ReferensiSekolah::create((array)$this->dtSekolah->rows);
        }

        $this->updateKopSurat();
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Tersimpan."
        ]);
    }

    public function syncDtGtk(){
        foreach ($this->dtGtk->rows as $key => $gtk) {
            $gtkInsert = (array)$gtk;
            unset($gtkInsert['rwy_pend_formal']);
            unset($gtkInsert['rwy_kepangkatan']);
            $gtkInserted = ReferensiGtk::updateOrCreate([
                'tahun_ajaran_id' => $gtk->tahun_ajaran_id,
                'ptk_id' => $gtk->ptk_id
            ], $gtkInsert);

            //data Pendidikan formal
            foreach ($gtk->rwy_pend_formal as $key => $pendFormal) {
                $dtPendFormal = (array)$pendFormal;
                $dtPendFormal['referensi_gtk_id'] = $gtkInserted->id;
                ReferensiPendFormal::create($dtPendFormal);
            }

            foreach ($gtk->rwy_kepangkatan as $key => $kepangkatan) {
                $dtKepangkatan = (array)$kepangkatan;
                $dtKepangkatan['referensi_gtk_id'] = $gtkInserted->id;
                ReferensiKepangkatan::create($dtKepangkatan);
            }
        }
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Tersimpan."
        ]);
    }

    public function syncDtSiswa(){
        // dd($this->dtSiswa->rows);
        foreach ($this->dtSiswa->rows as $key => $dtSiswa) {
            ReferensiSiswa::updateOrCreate([
                'nik' => $dtSiswa->nik
            ], (array)$dtSiswa);
        }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Tersimpan."
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Tersimpan."
        ]);
    }

    public function updateKopSurat(){
        if ($this->dtSekolah != null) {
            // dd("sampe sini");
            $kopSekolah = SettingKopSurat::first();
            $dtSekolah = $this->dtSekolah->rows;

            $namaSekolah = substr(strstr($dtSekolah->nama," "), 1);
            $jenjang = config('eletter.setting_kop_bentuk_pendidikan');

            $data = [
                'line1' => "PEMERINTAH PROVINSI DI INDONESIA",
                'line2' => "DINAS PENDIDIKAN DAN KEBUDAYAAN",
                'nama_sekolah' => $jenjang[$dtSekolah->bentuk_pendidikan_id_str]." ".$namaSekolah,
                'alamat' => $dtSekolah->alamat_jalan,
                'telepon' => $dtSekolah->nomor_telepon,
                'fax' => $dtSekolah->nomor_fax,
                'kota_kabupaten' => $dtSekolah->kabupaten_kota,
                'kode_pos' => $dtSekolah->kode_pos,
                'email' => $dtSekolah->email,
                'website' => $dtSekolah->website
            ];

            if($kopSekolah != null){
                $kopSekolah->update($data);
                return;
            }

            SettingKopSurat::create($data);
        }
    }

}
