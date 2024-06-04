<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfViewer extends Controller
{
    public function index($pdf){
        $url = explode('_', $pdf);
        $bulan = \Carbon\Carbon::parse($url[0]."-".$url[1]."-01")->locale('id')->translatedFormat("F");
        return view('pdfviewer', compact('url', 'bulan'));
    }
}
