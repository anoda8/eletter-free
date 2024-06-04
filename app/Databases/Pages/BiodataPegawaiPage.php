<?php

namespace App\Databases\Pages;

use App\Models\BiodataPegawai;
use App\Models\ReferensiGtk;
use Livewire\Component;

class BiodataPegawaiPage extends Component
{
    public function render()
    {
        return view('databases.pages.biodata-pegawai-page');
    }

    public function importDtReferensi(){
        $referensi = ReferensiGtk::all();
        foreach ($referensi as $key => $ref) {
            BiodataPegawai::updateOrCreate([
                'nik' => $ref->nik,
            ],[
                'user_id' => $ref->user_id,
                'referensi_gtk_id' => $ref->referensi_gtk_id,
                'nama' => $ref->nama,
                'jenis_kelamin' => $ref->jenis_kelamin,
                'tempat_lahir' => $ref->tempat_lahir,
                'tanggal_lahir' => $ref->tanggal_lahir,
                'agama_id_str' => $ref->agama_id_str,
                'nuptk' => $ref->nuptk,
                'nik' => $ref->nik,
                'jenis_ptk_id_str' => $ref->jenis_ptk_id_str,
                'status_kepegawaian_id_str' => $ref->status_kepegawaian_id_str,
                'nip' => $ref->nip,
                'pendidikan_terakhir' => $ref->pendidikan_terakhir,
                'bidang_studi_terakhir' => $ref->bidang_studi_terakhir,
                'pangkat_golongan_terakhir' => $ref->pangkat_golongan_terakhir,
                'gelar_depan' => $ref->gelar_depan,
                'gelar_belakang' => $ref->gelar_belakang,
            ]);
        }

        $this->dispatch('refreshDatatable');
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Update data berhasil."
        ]);

    }
}
