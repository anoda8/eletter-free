<?php

namespace App\FormatSurat\SuketSiswa\Pages;

use App\Models\FormatKeteranganSiswa;
use App\Models\SettingKopSurat;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CetakKeteranganSiswa extends Component
{
    public function render()
    {
        return view('format-surat.suket-siswa.pages.cetak-keterangan-siswa');
    }

    public function cetak($suketId){
        $suratKeterangan = FormatKeteranganSiswa::find($suketId);
        $data = [
            'kopSurat' => SettingKopSurat::first(),
        ];
        $pdf = Pdf::set_option('isHtml5ParserEnabled', false)->setPaper([0.0, 0.0, 612.00, 936.00], 'portrait')->loadView('format-surat.suket-siswa.pages.file-cetak-keterangan-siswa', compact('data', 'suratKeterangan'));
        return $pdf->stream('surat-keterangan-'.$suketId.'.pdf');
    }
}
