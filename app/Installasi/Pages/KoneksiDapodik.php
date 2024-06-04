<?php

namespace App\Installasi\Pages;

use App\Models\ReferensiGtk;
use App\Models\ReferensiKepangkatan;
use App\Models\ReferensiPendFormal;
use App\Models\ReferensiSekolah;
use App\Models\ReferensiSiswa;
use App\Models\SettingDapodik;
use App\Models\SettingKopSurat;
use App\Traits\Dapodik;
use Livewire\Attributes\Validate;
use Livewire\Component;

class KoneksiDapodik extends Component
{
    use Dapodik;

    #[Validate('required')]
    public $ipAplikasi, $ipDapodik, $kunciDapodik, $npsn;

    public $dapodik;

    public $statusKoneksi = false;

    public $dtSekolah, $dtGtk, $dtSiswa;

    public $progDtSekolah = 0;
    public $progDtGtk = 0;
    public $progDtSiswa = 0;

    public function mount(){
        $this->dapodik = SettingDapodik::first();
        $this->ipAplikasi = $this->dapodik->ip_aplikasi;
        $this->ipDapodik = $this->dapodik->ip_dapodik;
        $this->kunciDapodik = $this->dapodik->key;
        $this->npsn = $this->dapodik->npsn;
    }

    public function render()
    {
        return view('installasi.pages.koneksi-dapodik');
    }

    public function simpanDapodik(){
        $this->validate();

        SettingDapodik::where('id', $this->dapodik->id)->update([
            'ip_aplikasi' => $this->ipAplikasi,
            'ip_dapodik' => $this->ipDapodik,
            'key' => $this->kunciDapodik,
            'npsn' => $this->npsn,
        ]);

        if(is_object($this->dataSekolah())){
            $this->statusKoneksi = true;

            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Koneksi dapodik sukses."
            ]);
        }else{
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Koneksi gagal, periksa lagi koneksi dapodik."
            ]);
        }
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
        $this->progDtSekolah = 100;
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
            $this->progDtGtk++;
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
            $this->progDtSiswa++;
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
