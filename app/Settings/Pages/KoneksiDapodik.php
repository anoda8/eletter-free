<?php

namespace App\Settings\Pages;

use App\Models\SettingDapodik;
use App\Traits\Dapodik;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KoneksiDapodik extends Component
{
    use Dapodik;
    public $dapodik;

    #[Validate('required')]
    public $namaKoneksi, $ipAplikasi, $ipDapodik, $key, $npsn;

    public $statusKoneksi = true;

    public function mount(){
        $this->dapodik = SettingDapodik::first();
        $this->namaKoneksi = $this->dapodik->nama_koneksi;
        $this->ipAplikasi = $this->dapodik->ip_aplikasi;
        $this->ipDapodik = $this->dapodik->ip_dapodik;
        $this->key = $this->dapodik->key;
        $this->npsn = $this->dapodik->npsn;

        if(!is_object($this->dataSekolah())){
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Tidak terhubung dengan server dapodik."
            ]);
            $this->statusKoneksi = false;
        }
    }

    public function render()
    {
        return view('settings.pages.koneksi-dapodik');
    }

    public function simpan(){
        SettingDapodik::where('id', $this->dapodik->id)->update([
            'nama_koneksi' => $this->namaKoneksi,
            'ip_aplikasi' => $this->ipAplikasi,
            'ip_dapodik' => $this->ipDapodik,
            'key' => $this->key,
            'npsn' => $this->npsn,
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Tersimpan."
        ]);
    }

    public function cekKoneksiDapodik(){
        $status = is_object($this->dataSekolah());
        // dd($this->dataSekolah());
        $this->dispatch('show-alert', [
            'icon' => $status ? 'success' : 'error',
            'message' => $status ? "Terhubung dengan server dapodik." : "Tidak terhubung dengan server dapodik."
        ]);
        $this->statusKoneksi = $status;
    }
}
