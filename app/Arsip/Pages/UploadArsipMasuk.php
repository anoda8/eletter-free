<?php

namespace App\Arsip\Pages;

use App\Models\FileArsipMasuk;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadArsipMasuk extends Component
{
    use WithFileUploads;

    public $uploaded = false;
    public $fileArsipId;
    public $perihalTerupload;

    #[Validate('required|mimes:pdf|max:2048', message: "Ekstensi file pdf dengan maksimal 2 Mb.")]
    public $file;

    #[Validate('required')]
    public $perihal;

    public $fileDihapus;

    public function render()
    {
        $listFileArsip = FileArsipMasuk::where('terarsip', 0)->get();
        return view('arsip.pages.upload-arsip-masuk', compact('listFileArsip'));
    }

    public function uploadFile(){
        $this->validate();

        $fileArsip = FileArsipMasuk::create([
            'perihal' => $this->perihal,
            'user_id' => auth()->user()->id,
        ]);

        $date = \Carbon\Carbon::parse($fileArsip->created_at);
        $monthCreated   = $date->format("m");
        $yearCreated    = $date->format("Y");

        $this->file->storeAs(path: 'public/uploads/', name: $fileArsip->id.".pdf");
        $this->uploaded = true;
        $this->fileArsipId = $fileArsip->id;
        $this->perihalTerupload = $this->perihal;
        $this->reset(['file', 'perihal']);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "File Terupload"
        ]);
    }

    public function pilihFileDihapus($fileId){
        $this->fileDihapus = FileArsipMasuk::find($fileId);
    }

    public function hapusFile(){
        Storage::delete('/public/uploads/'.$this->fileDihapus->id);
        $this->fileDihapus->delete();
        $this->dispatch('close-modal', ['modalName' => "modalKonfirmasiHapus"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "File surat masuk terhapus"
        ]);
    }
}
