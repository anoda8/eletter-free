<?php

namespace App\Backup\Pages\ArsipMasuk;

use App\Models\ArsipMasuk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use ZipArchive;

class BackupArsipMasuk extends Component
{
    public $selectTahun, $selectBulan;

    public $jumlahDisposisi = [];

    public $counterSurmas  = [],  $counterDisposisi =  [];

    public function render()
    {
        $listBulan = (array)json_decode(file_get_contents("https://api.npoint.io/def8600c191be7327483"));
        $listTahun = ArsipMasuk::groupBy('tahun')->select('tahun', DB::raw('count(*) as total'))->get();
        return view('backup.pages.arsip-masuk.backup-arsip-masuk', compact('listTahun', 'listBulan'));
    }

    public function countArsipMasuk(){
        $start = $this->selectTahun."-".$this->selectBulan."-01";
        $ends = $this->selectTahun."-".$this->selectBulan."-31";
        $arsipMasuks = ArsipMasuk::where('status', 1)->whereBetween('tanggal_diterima', [$start, $ends])->get();
        $bulanKata = Carbon::parse($start)->locale('id')->translatedFormat('F');
        foreach ($arsipMasuks as $key => $arsipMasuk) {
            if(Storage::exists('public/arsip/'.$this->selectTahun.'/surat-masuk/'.$bulanKata.'/'.$arsipMasuk->id.'.pdf')){
                $this->counterSurmas[] = [
                    'path' => 'public/arsip/'.$this->selectTahun.'/surat-masuk/'.$bulanKata.'/'.$arsipMasuk->id.'.pdf',
                    'fileName' => "[".$arsipMasuk->nomor_agenda."-".$arsipMasuk->klasifikasi->kode."] ".$arsipMasuk->perihal.".pdf"
                ];
            }

            if(Storage::exists('public/arsip/'.$this->selectTahun.'/surat-masuk/'.$bulanKata.'/'.$arsipMasuk->id.'_disposisi.pdf')){
                $this->counterDisposisi[] = [
                    'path' => 'public/arsip/'.$this->selectTahun.'/surat-masuk/'.$bulanKata.'/'.$arsipMasuk->id.'_disposisi.pdf',
                    'fileName' => "[".$arsipMasuk->nomor_agenda."-".$arsipMasuk->klasifikasi->kode."][disposisi] ".$arsipMasuk->perihal.".pdf"
                ];
            }
        }
    }

    public function doBackup(){
        $zip = new \ZipArchive();
        $zipFileName = "SuratMasuk_".date("Y-m-d_H-i-s").".zip";

        // dd(public_path());
        if($zip->open("backup/".$zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true){
            dd("An error occurred creating your ZIP file.");
        }
        // $zip->open("backup/".$zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        foreach ($this->counterSurmas as $file) {
            $zip->addFile(storage_path('app/'.$file['path']), basename($file['fileName']));
        }
        foreach ($this->counterDisposisi as $file) {
            $zip->addFile(storage_path('app/'.$file['path']), basename($file['fileName']));
        }
        $zip->close();
        return response()->download("backup/".$zipFileName)->deleteFileAfterSend(true);
        // if($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE){

        // }else {
        //     dd("Failed to create the zip file.");
        // }
    }
}

