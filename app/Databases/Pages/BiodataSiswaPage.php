<?php

namespace App\Databases\Pages;

use App\Models\BiodataSiswa;
use App\Models\DataKelas;
use App\Models\ReferensiSiswa;
use Livewire\Component;

class BiodataSiswaPage extends Component
{
    public function render()
    {
        return view('databases.pages.biodata-siswa-page');
    }

    public function importDtReferensi(){
        $referensiSiswas = ReferensiSiswa::all();

        foreach ($referensiSiswas as $key => $ref) {
            BiodataSiswa::updateOrCreate([
                'nik'=> $ref->nik,
            ], [
                'peserta_didik_id'=> $ref->peserta_didik_id,
                'nipd'=> $ref->nipd,
                'tanggal_masuk_sekolah'=> $ref->tanggal_masuk_sekolah,
                'sekolah_asal'=> $ref->sekolah_asal,
                'nama'=> $ref->nama,
                'nisn'=> $ref->nisn,
                'jenis_kelamin'=> $ref->jenis_kelamin,
                'nik'=> $ref->nik,
                'tempat_lahir'=> $ref->tempat_lahir,
                'tanggal_lahir'=> $ref->tanggal_lahir,
                'agama_id_str'=> $ref->agama_id_str,
                'alamat_jalan'=> $ref->alamat_jalan,
                'nomor_telepon_rumah'=> $ref->nomor_telepon_rumah,
                'nomor_hp'=> $ref->nomor_telepon_seluler,
                'nama_ayah'=> $ref->nama_ayah,
                'pekerjaan_ayah_id_str'=> $ref->pekerjaan_ayah_id_str,
                'nama_ibu'=> $ref->nama_ibu,
                'pekerjaan_ibu_id_str'=> $ref->pekerjaan_ibu_id_str,
                'nama_wali'=> $ref->nama_wali,
                'pekerjaan_wali_id_str'=> $ref->pekerjaan_wali_id_str,
                'anak_keberapa'=> $ref->anak_keberapa,
                'tinggi_badan'=> $ref->tinggi_badan,
                'berat_badan'=> $ref->berat_badan,
                'email'=> $ref->email,
                'semester_id'=> $ref->semester_id,
                'nama_rombel'=> $ref->nama_rombel,
                'kurikulum_id_str'=> $ref->kurikulum_id_str,
                'kebutuhan_khusus'=> $ref->kebutuhan_khusus,
            ]);
        }

        $this->generateKelas();

        $this->dispatch('refreshDatatable');
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Update data berhasil."
        ]);
    }

    public function generateKelas(){
        $kelases = BiodataSiswa::groupBy('nama_rombel')->selectRaw('count(*) as total, nama_rombel')->get();
        foreach ($kelases as $key => $kelas) {
            DataKelas::create([
                'nama_rombel' => $kelas->nama_rombel
            ]);
        }
    }
}
