<?php

namespace App\Whatsapp\Form;

use App\Models\ArsipKeluar;
use App\Models\BiodataSiswa;
use App\Models\WhatsappMessage;
use App\Traits\Fonnte;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class PesanSemua extends Component
{
    use WithFileUploads, Fonnte;

    public $suratKeluar;

    #[Validate('required')]
    public $isiPesan, $kirimKe = [];

    public $tanggal;

    #[Validate('nullable|mimes:pdf|max:2048')]
    public $berkas;

    public $cariSuratKeluar, $listSuratKeluar = [];

    public function render()
    {
        if($this->cariSuratKeluar != null){
            $this->listSuratKeluar = ArsipKeluar::where('perihal', 'like', "%".$this->cariSuratKeluar."%")->get()->take(3);
        }
        return view('whatsapp.form.pesan-semua');
    }

    public function pilihSuratKeluar($suratKeluarId){
        $this->suratKeluar = ArsipKeluar::find($suratKeluarId);
        $this->tanggal = Carbon::parse($this->suratKeluar->created_at);
        $this->reset(['cariSuratKeluar', 'listSuratKeluar']);
    }

    public function resetSuratKeluar(){
        $this->reset(['suratKeluar', 'tanggal']);
    }

    public function simpanDanKirim(){
        $this->validate();
        $waMessage = null;
        $link = null;

        if($this->berkas != null){
            $waMessage = WhatsappMessage::create([
                'text' => $this->isiPesan
            ]);

            $this->berkas->storeAs(path: 'public/pesan-wa/', name: $waMessage->id.".pdf");

            $link = 'public/pesan-wa/'.$waMessage->id.".pdf";
        }
            // dd("sampe sini");
        if($this->suratKeluar != null){
            $waMessage = WhatsappMessage::create([
                'text' => $this->isiPesan, 'surat_keluar_id' => $this->suratKeluar->id
            ]);

            $link = 'storage/arsip/'.$this->tanggal->year.'/surat-keluar/'.$this->tanggal->locale('id')->translatedFormat('F').'/'.$this->suratKeluar->id.'.pdf';
        }

        if(($link != null) && ($this->suratKeluar->status >= 2)){
$newPesan = $this->isiPesan."

*Unduh Berkas*
".config('app.url')."/".$link."

Dikirim Oleh : ".auth()->user()->name;

        $waMessage->update([
            'text' => $newPesan
        ]);
        }else{
            $newPesan = $this->isiPesan."

Dikirim Oleh : ".auth()->user()->name;
        }

        // $siswas = BiodataSiswa::all();
        $siswas = BiodataSiswa::where('nipd', '7599')->get();

        $counter = 0;
        if(count($this->kirimKe) > 0){
            // dd($this->kirimKe);
            foreach ($siswas as $key => $siswa) {
                foreach ($this->kirimKe as $key => $kirim) {
                    if ($siswa->nomor_terverifikasi == 1) {
                        if ($kirim == 'siswa') {
                            $this->sendMessage($siswa->nomor_hp, $newPesan, 'pesan-wa');
                            $counter++;
                        }

                        if ($kirim == 'ortu') {
                            $this->sendMessage($siswa->nomor_hp_ortu, $newPesan, 'pesan-wa');
                            $counter++;
                        }
                    }
                }
            }
        }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => $counter." pesan terkirim."
        ]);
    }
}
