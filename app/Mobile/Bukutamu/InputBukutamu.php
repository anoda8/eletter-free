<?php

namespace App\Mobile\Bukutamu;

use App\Models\AddonsBukutamu;
use App\Models\BiodataPegawai;
use App\Models\JabatanPegawai;
use App\Models\ReferensiSekolah;
use App\Models\SettingJabatan;
use App\Traits\Fonnte;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class InputBukutamu extends Component
{
    use Fonnte;

    public $dataSekolah;
    public $waktu;

    #[Validate('required')]
    public $nama, $jabatan, $nomorHp, $alamat, $keperluan;

    public $bertemuDengan;

    public $instansi, $photoUrl, $image;

    public $jabatanTerpilih, $namaTerpilih, $cariNama, $listNama = [];

    public $terkirim = false;
    public $showSaran = false, $isiBukutamuId, $saran;

    public function mount(){
        $this->dataSekolah = ReferensiSekolah::first();
        $this->waktu = Carbon::now()->locale('id')->translatedFormat("l, d F Y H:i");
    }

    #[Layout('layouts.mobile')]
    public function render()
    {
        $listJabatan = SettingJabatan::with(['jabatanPegawai'])->where('tampil_disposisi', 1)->orderBy('sort', 'asc')->get();
        if($this->cariNama != null){
            $this->listNama = BiodataPegawai::where('nama', 'like', "%".$this->cariNama."%")->get()->take(3);
        }
        return view('mobile.bukutamu.input-bukutamu', compact('listJabatan'));
    }

    public function setImageText($value){
        // dd($value);
        $this->image = $value;
    }

    public function pilihJabatan($jabatanPegawaiId){
        $this->jabatanTerpilih = JabatanPegawai::find($jabatanPegawaiId);
        $this->namaTerpilih = null;
        $this->dispatch('close-modal', ['modalName' => "modalPilihJabatan"]);
    }

    public function pilihNama($pegawaiId){
        $this->namaTerpilih = BiodataPegawai::find($pegawaiId);
        $this->jabatanTerpilih = null;
        $this->reset(['cariNama', 'listNama']);
    }

    public function hapusNama(){
        $this->namaTerpilih =  null;
    }

    public function simpan(){
        $this->validate();

        // dd($this->image);
        if(($this->jabatanTerpilih == null) && ($this->namaTerpilih == null)){
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Isi nama pegawai yang akan ditemui."
            ]);
            return;
        }

        if($this->jabatanTerpilih != null){
            $this->namaTerpilih = $this->jabatanTerpilih->pegawai;
        }


        $folderPath = "bukutamu/".date("Y")."/";
        $image_parts = explode(";base64,", $this->image);

        // dd($image_parts);

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;

        Storage::disk('public')->put($file, $image_base64);

        $isiBukutamu = AddonsBukutamu::create([
            'nama' => $this->nama,
            'jabatan' => $this->jabatan,
            'nomor_hp' => $this->nomorHp,
            'alamat' => $this->alamat,
            'instansi' => $this->instansi,
            'keperluan' => $this->keperluan,
            'bertemu_dengan' => $this->namaTerpilih->id,
            'photo_url' => $fileName
        ]);

        $this->isiBukutamuId = $isiBukutamu->id;
        $linkFoto = config('app.url')."/storage/bukutamu/".date("Y")."/".$fileName;
        $pesan = $linkFoto."

*KUNJUNGAN TAMU* (".Carbon::now()->format("m/d/Y").")

Nama : ".$this->nama."
Jabatan : ".$this->jabatan."
Instansi : ".$this->instansi."
Nomor HP : ".$this->nomorHp."
Alamat : ".$this->alamat."
Bertemu dengan : ".$this->namaTerpilih->nama."
*Keperluan* : ".$this->keperluan."

        ";

        $kirimPesan = $this->sendMessage($this->namaTerpilih->nomor_hp, $pesan, "bukutamu");

        if($kirimPesan['data']->status == true){
            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Pesan terkirim, mohon menunggu."
            ]);
        }

        $this->terkirim = true;
    }

    public function simpanSaran(){
        if($this->isiBukutamuId != null){
            if($this->saran != null){
                AddonsBukutamu::find($this->isiBukutamuId)->update([
                    'saran' => $this->saran
                ]);

                $this->dispatch('show-alert', [
                    'icon' => 'success', 'message' => "Saran terkirim."
                ]);

                $this->showSaran = false;
            }
        }
    }

    public function toggleSaran(){
        $this->showSaran = !$this->showSaran;
    }
}
