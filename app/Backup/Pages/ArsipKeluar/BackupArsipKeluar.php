<?php

namespace App\Backup\Pages\ArsipKeluar;

use App\Models\ArsipKeluar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class BackupArsipKeluar extends Component
{
    public $selectTahun, $selectBulan;

    public $counterSurkel = [];

    public function render()
    {
        $listBulan = (array)json_decode(file_get_contents("https://api.npoint.io/def8600c191be7327483"));
        $listTahun = ArsipKeluar::groupBy('tahun')->select('tahun', DB::raw('count(*) as total'))->get();
        return view('backup.pages.arsip-keluar.backup-arsip-keluar', compact('listTahun', 'listBulan'));
    }

    public function countArsipKeluar(){
        $start = $this->selectTahun."-".$this->selectBulan."-01";
        $ends = $this->selectTahun."-".$this->selectBulan."-31";
        $arsipKeluars = ArsipKeluar::where('status', 2)->whereBetween('tanggal_surat', [$start, $ends])->get();
        $bulanKata = Carbon::parse($start)->locale('id')->translatedFormat('F');
        foreach ($arsipKeluars as $key => $arsipKeluar) {
            if(Storage::exists('public/arsip/'.$this->selectTahun.'/surat-keluar/'.$bulanKata.'/'.$arsipKeluar->id.'.pdf')){
                $namafile = str_replace("/", "_", $arsipKeluar->perihal);
                $this->counterSurkel[] = [
                    'path' => 'public/arsip/'.$this->selectTahun.'/surat-keluar/'.$bulanKata.'/'.$arsipKeluar->id.'.pdf',
                    'fileName' => "[".$arsipKeluar->nomor_agenda."-".$arsipKeluar->klasifikasi->kode."] ".$namafile.".pdf"
                ];
            }
        }
    }

    public function doBackup(){
        $zip = new \ZipArchive();
        $zipFileName = "SuratKeluar_".date("Y-m-d_H-i-s").".zip";

        if($zip->open("backup/".$zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true){
            dd("An error occurred creating your ZIP file.");
        }

        foreach ($this->counterSurkel as $file) {
            $zip->addFile(storage_path('app/'.$file['path']), basename($file['fileName']));
        }

        $zip->close();
        return response()->download("backup/".$zipFileName)->deleteFileAfterSend(true);
    }
}
