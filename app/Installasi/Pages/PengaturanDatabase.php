<?php

namespace App\Installasi\Pages;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Validate;
use Livewire\Component;
use PDO;

class PengaturanDatabase extends Component
{
    #[Validate('required')]
    public $namaAplikasi, $hostAplikasi, $namaDatabase, $userDatabase;

    public $passwordDatabase;

    public $errorMessage;

    public function mount(){
        $this->hostAplikasi = "http://localhost";
    }

    public function render()
    {
        return view('installasi.pages.pengaturan-database');
    }

    public function submit(){
        $this->validate();
        $this->errorMessage = null;
        $hosts = explode("/", $this->hostAplikasi, 3);

        if(strpos($this->hostAplikasi, "://") == false){
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Gagal, Gunakan alamat url aplikasi yang benar."
            ]);
            return;
        }

        try{
            new PDO("mysql:host=".$hosts[2].";dbname=".$this->namaDatabase.";charset=utf8", $this->userDatabase, $this->passwordDatabase);
            $this->dispatch('change-step-user');
            $this->updateEnv([
                'APP_NAME' => '"'.$this->namaAplikasi.'"',
                'DB_DATABASE' => $this->namaDatabase,
                'MODE_INSTALLASI' => false
            ]);

            return redirect('installasi/mode-migration');
        }catch(\PDOException $e){
            $this->errorMessage = $e->getMessage();
            return $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Gagal, Periksa pengaturan koneksi database."
            ]);
        }
    }

    public function updateEnv(array $data){
        $envFile = base_path('.env');
        $contents = File::get($envFile);
        $lines = explode("\n", $contents);
        // dd($lines);
        foreach ($lines as $key => $line) {
            if(empty($line) || str_starts_with("#", $line)){
                continue;
            }

            $parts = explode("=", $line, 2);
            $kunci = $parts[0];

            if(isset($data[$kunci])){
                $line = $kunci."=".$data[$kunci];
                $lines[$key] = $line;
            }

        }

        $updatedContents = implode("\n", $lines);

        File::put($envFile, $updatedContents);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Suksess, pengaturan database tersimpan."
        ]);
    }


}
