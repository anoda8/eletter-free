<?php

namespace App\FormatSurat\Pages;

use App\Models\FormatSuratTugas;
use App\Models\SettingKopSurat;
use App\Traits\OnlineData;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CetakSuratTugas extends Component
{
    use OnlineData;

    public function mount(){
    }

    public function render()
    {
        return view('format-surat.pages.cetak-surat-tugas');
    }

    public function cetak($suratTugasId){
        $suratTugas = FormatSuratTugas::find($suratTugasId);
        $data = [
            'kopSurat' => SettingKopSurat::first(),
            'pangkatGolongan' => $this->getPangkatGolongan(),
        ];
        $pdf = Pdf::set_option('isHtml5ParserEnabled', false)->setPaper([0.0, 0.0, 612.00, 936.00], 'portrait')->loadView('format-surat.pages.cetak-surat-tugas', compact('data', 'suratTugas'));
        return $pdf->stream('surattugas.pdf');
    }
}
