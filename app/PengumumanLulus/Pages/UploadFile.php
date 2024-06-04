<?php

namespace App\PengumumanLulus\Pages;

use App\Models\BiodataSiswa;
use App\Models\PengumumanLulus;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public $kelasTambah;

    #[Validate(['fileSurkel.*' => 'mimes:pdf|max:2048'])]
    public $fileSurkel = [];

    public function render()
    {
        $listKelas = BiodataSiswa::groupBy('nama_rombel')->selectRaw('count(*) as total, nama_rombel')->orderBy('nama_rombel', 'asc')->get();
        return view('pengumuman-lulus.pages.upload-file', compact('listKelas'));
    }

    public function tambahKelas(){
        if($this->kelasTambah != null){
            $siswas = BiodataSiswa::where('nama_rombel', $this->kelasTambah)->get();
            foreach ($siswas as $key => $siswa) {
                PengumumanLulus::firstOrCreate([
                    'biodata_siswa_id' => $siswa->id,
                    'tahun' => date("Y")
                ]);
            }
        }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Siswa kelas ".$this->kelasTambah." berhasil ditambahkan."
        ]);

        $this->dispatch('close-modal', ['modalName' => "modalTambahSiswaLulus"]);
        $this->dispatch('refreshDatatable');
        $this->reset(['kelasTambah']);
    }

    public function uploadFile(){
        if(count($this->fileSurkel) > 10){
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Upload maksimal 40 berkas"
            ]);
        }else{
            $counter = 0;
            foreach ($this->fileSurkel as $file) {
                $fileName = $file->getClientOriginalName();
                // dd($fileName);
                $nipd = explode(".", $fileName)[0];
                $siswa = BiodataSiswa::where('nipd', $nipd)->get()->first();
                // dd($siswa);
                //cari di pengumuman lulus
                if($siswa != null){
                    $pgmn = PengumumanLulus::where('biodata_siswa_id', $siswa->id);
                    if($pgmn != null){
                        $file->storeAs(path: 'public/pengumuman-lulus/'.date("Y"), name: $pgmn->get()->first()->id.".pdf");
                        $pgmn->update([
                            'status' => 1
                        ]);
                        $counter++;
                    }
                }
            }

            if($counter > 0){
                $this->dispatch('show-alert', [
                    'icon' => 'success', 'message' => $counter." berkas terupload"
                ]);
            }
        }

    }
}
