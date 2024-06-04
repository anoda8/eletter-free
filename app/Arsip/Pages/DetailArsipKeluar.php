<?php

namespace App\Arsip\Pages;

use App\Models\ArsipKeluar;
use App\Models\ArsipKeluarFile;
use App\Models\BiodataPegawai;
use App\Models\KlasifikasiSurat;
use App\Models\User;
use App\Traits\Fonnte;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailArsipKeluar extends Component
{
    use WithFileUploads, Fonnte;

    public $arsipKeluar, $createdAt;

    #[Validate('required|mimes:pdf|max:2048', message: "Ekstensi file pdf dengan maksimal 2 Mb.")]
    public $berkasUpload;

    public $listPegawai;

    public $tanggalSurat, $perihal, $kodeKlasifikasi;

    public $author;

    // public $listKodeKlasifikasi = [];

    public $owner = false;

    public function mount($arsipKeluarId){
        $this->listPegawai = BiodataPegawai::with('user')->orderBy('nama', 'asc')->get();
        $this->arsipKeluar = ArsipKeluar::with(['file', 'author'])->find($arsipKeluarId);
        $this->createdAt = Carbon::parse($this->arsipKeluar->tanggal_surat);

        if($this->arsipKeluar->user_id == auth()->user()->id){
            $this->owner = true;
        }

        $this->tanggalSurat = $this->arsipKeluar->tanggal_surat;
        $this->perihal = $this->arsipKeluar->perihal;
        $this->kodeKlasifikasi = $this->arsipKeluar->klasifikasi->kode;
        $this->author = $this->arsipKeluar->user_id;
    }

    public function render()
    {
        $listKodeKlasifikasi = [];
        if($this->kodeKlasifikasi != null){
            $listKodeKlasifikasi = KlasifikasiSurat::whereAny(['kode', 'klasifikasi'], 'like', "%".$this->kodeKlasifikasi."%")->get();
        }
        return view('arsip.pages.detail-arsip-keluar', compact('listKodeKlasifikasi'));
    }

    public function doUploadBerkas(){
        $this->validate();

        $tanggal = $this->createdAt;
        $this->berkasUpload->storeAs(path: "/public/arsip/".$tanggal->year."/surat-keluar/".$tanggal->locale('id')->translatedFormat("F"), name: $this->arsipKeluar->id.".pdf");

        $this->arsipKeluar->update([
            'status' => 2
        ]);

        ArsipKeluarFile::updateOrCreate([
            'arsip_keluar_id' => $this->arsipKeluar->id,
        ],[
            'arsip_keluar_id' => $this->arsipKeluar->id,
            'mode_berkas' => 'arsip',
            'lampiran' => null
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Surat Keluar Tersimpan."
        ]);
        $this->dispatch('close-modal', ['modalName' => "modalUploadArsip"]);
    }

    public function simpanDetailSuratKeluar(){
        if(in_array(null, [$this->tanggalSurat, $this->perihal, $this->kodeKlasifikasi])){
            return throw ValidationException::withMessages(['nomorSurat' => "Lengkapi form !"]);
        }

        $kodeKlasifikasi = trim(explode("-", $this->kodeKlasifikasi)[0]);
        $klasifikasi = KlasifikasiSurat::where('kode', $kodeKlasifikasi)->get()->first();
        $this->arsipKeluar->update([
            'tanggal_surat' => $this->tanggalSurat,
            'perihal' => $this->perihal,
            'nomor_klasifikasi' => $klasifikasi->id
        ]);

        $this->dispatch('close-modal', ["modalName" => "modalEditDetail"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Update berhasil."
        ]);

        $this->reset(['tanggalSurat', 'perihal', 'kodeKlasifikasi']);
    }

    public function updatingAuthor($value){
        $user = User::select('name')->find($value);
        $this->arsipKeluar->update([
            'user_id' => $value
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Author diubah menjadi ".$user->name
        ]);
    }

    public function kirimTagihan(){
        $author = BiodataPegawai::where('user_id', $this->author)->get()->first();
$pesan = "*TAGIHAN SURAT*

*Nomor* : ".$this->arsipKeluar->klasifikasi->kode."/".$this->arsipKeluar->nomor_agenda."
*Perihal* : ".$this->arsipKeluar->perihal."

Mohon untuk menyerahkan berkas surat kepada bagian persuratan, terimakasih.
";
        if($author->nomor_hp != null){
            $this->sendMessage($author->nomor_hp, $pesan, 'tagihan-surat-keluar');
        }
    }
}
