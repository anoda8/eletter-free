<?php
namespace App\Traits;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

trait CetakDokumen{
    public function cetakDokumenLandscape(string $view, $data, $filename){
        $pdf = Pdf::set_option('isHtml5ParserEnabled', false)->setPaper([0.0, 0.0, 612.00, 936.00], 'landscape')->loadView($view, $data);
        return $pdf->stream($filename);
    }

    public function cetakDokumenPortrait(){

    }

    public function simpanDokumenLandscape(string $view, $data, $saveLocation){
        $pdf = Pdf::set_option('isHtml5ParserEnabled', false)->setPaper([0.0, 0.0, 612.00, 936.00], 'landscape')->loadView($view, $data);
        $pdf->save($saveLocation);
    }
}
