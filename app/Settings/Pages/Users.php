<?php

namespace App\Settings\Pages;

use App\Models\BiodataPegawai;
use App\Models\BiodataSiswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        return view('settings.pages.users');
    }

    public function deleteRecord($userId){
        User::find($userId)->delete();
        return redirect('/settings/users');
    }

    public function generatePegawai(){
        $biodataPegawai = BiodataPegawai::all();

        foreach ($biodataPegawai as $key => $pegawai) {
            $username = $pegawai->nip == null ? $pegawai->nik : $pegawai->nip;

            $user = User::updateOrCreate([
                'username' => $username
            ], [
                'username' => $username,
                'name' => $pegawai->nama,
                'email' => $username."@eletter.id",
                'password' => bcrypt($username),
            ]);

            BiodataPegawai::find($pegawai->id)->update([
                'user_id' => $user->id,
            ]);

            $jabatan = $pegawai->jenis_ptk_id_str;
            // dd($user);
            if($user->roles->count() < 1){
                switch ($jabatan) {
                    case 'Kepala Sekolah':
                        $user->addRole('kepsek');
                        break;
                    case 'Tenaga Administrasi Sekolah':
                        $user->addRole('taus');
                        break;
                    case 'Tukang Kebun':
                        $user->addRole('taus');
                        break;
                    case 'Guru Mapel':
                        $user->addRole('guru');
                        break;
                    case 'Guru BK':
                        $user->addRole('guru');
                        break;
                    default:
                        # code...
                        break;
                }
            }

        }

        $this->dispatch('close-modal', ['modalName' => "modalKonfirmasiGenerateUserPegawai"]);
        $this->dispatch('refreshDatatable');
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Sukses mengimpor user."
        ]);
    }

    public function generateSiswa(){
        $biodataSiswa = BiodataSiswa::all();
        ini_set('max_execution_time', 300);
        foreach($biodataSiswa as $siswa){
            $username = $siswa->nipd == null ? $siswa->nisn : $siswa->nipd;
            $password = Carbon::parse($siswa->tanggal_lahir)->format("ddmmYY");

            $user = User::updateOrCreate([
                'username' => $username
            ], [
                'username' => $username,
                'name' => $siswa->nama,
                'email' => $siswa->email == null ? $username."@eletter.id":$siswa->email,
                'password' => Hash::make($password),
            ]);

            BiodataSiswa::find($siswa->id)->update([
                'user_id' => $user->id
            ]);

            if(!$user->hasRole('siswa')){
                $user->addRole('siswa');
            }

        }

        $this->dispatch('refreshDatatable');
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Sukses mengimpor user siswa."
        ]);
    }
}
