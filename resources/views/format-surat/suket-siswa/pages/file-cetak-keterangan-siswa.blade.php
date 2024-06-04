<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keterangan Siswa</title>
    <style>
        html {
           margin-top: 35px;
           margin-bottom:0;
           padding-right: 0;
           font-size: 15px;
       }
       .page_break { page-break-before: always; }
       .judulDindikbudjateng{
           font-size: 18px;
           font-weight: bold;
       }
       .judulSmagapekalongan{
           font-size: 21px;
           font-weight: bold;
       }
       .judulDisposisi{
           font-weight: bold;
       }
       .judulAlamat{
           font-size: 15px;
       }
       .doubleLine{
          border-top:solid 2px;
          border-bottom:solid 4px;
          border-left: 0;
          border-right: 0;
       }
       .boxJudulSuket{
           text-align: center;
           padding-top: 70px;
       }
       .judulSuket{
           font-weight: bold;
           font-size: 18px;
       }
       .nomorSuket{
           font-weight: 16px;
           font-weight: bold;
           font-size: 18px;
       }
       .topParagraph{
           padding-top: 50px;

       }
       .paragraphSurGas{
            padding-left:44px;
            text-align: 'justify';
            line-height: 1.5;
            font-size: 17px;
       }
       .paragraphSurGasTable{
            padding-left:42px;
            padding-top:30px;
            padding-bottom: 30px;
            line-height: 1.5;
            font-size: 17px;
       }
       .paragraphSurGas ol li{
           line-height: 1.5;
           /*justify-content:*/
       }
       .tabelBiodataSuket{
            padding-left: 20px;
       }
       .judulTabelYbs{
           font-weight: bold;
           text-align: center;
           padding:5px;
       }
       .tabelYbs{
           width: 98%;
           margin-left: 24px;
           border-collapse: collapse;
       }
       .isiTabelYbs{
           padding:5px;
       }
       .tdTabelYbs{
           border-style: solid;
           border-color: black;
           border-width: 1px;
           border-spacing: 0px;
       }
       .textCenter{
           text-align: center;
       }
       .tabelWaktuTempat, tr, td{
           border-spacing: 0;
           padding: 0;
           margin: 0;
       }
       .judulSppd{
           text-align: center;
           margin-top: 40px;
           margin-bottom: 40px;
       }
       .textJudulSppd{
           text-decoration: underline;
           font-weight: bold;
           font-size: 16px;
       }
       .tabelSppd{
           border-collapse: collapse;
           border-style: solid;
           border-color: black;
           border-width: 1px;
           border-spacing: 0px;
           width: 100%;
       }
       .tabelSppdTrTd{
           border-collapse: collapse;
           border-style: solid;
           border-color: black;
           border-width: 1px;
           border-spacing: 0px;
           border-spacing: 0;
           padding: 0;
           margin: 0;
       }
   </style>
</head>
<body>
    <table class="table table-primary">
        <tbody>
            @include('components.kop-surat', ['kopSurat' => $data['kopSurat']])
            <tr>
                <td class="boxJudulSuket" colspan="2">
                    <div class="judulSuket"><u>SURAT KETERANGAN</u></div>
                    <div class="nomorSuket">Nomor :
                        {{ $suratKeterangan->arsipKeluar->klasifikasi->kode }} &nbsp; / &nbsp;
                        {!! $suratKeterangan->arsipKeluar->nomor_agenda == null ? "-" :  $suratKeterangan->arsipKeluar->nomor_agenda!!}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas topParagraph" colspan="2">
                    {{ $suratKeterangan->yang_menerangkan }}
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGasTable" colspan="2">
                    <table id="tableDetailSiswa" class="tableDetailSiswa">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td class="tabelBiodataSuket">: {{ $suratKeterangan->nama }}</td>
                            </tr>
                            <tr>
                                <td>Tempat, tanggal lahir</td>
                                <td class="tabelBiodataSuket">: {{ $suratKeterangan->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($suratKeterangan->tanggal_lahir)->locale('id')->translatedFormat("d F Y") }}
                                </td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td class="tabelBiodataSuket">: {{ $suratKeterangan->kelas }}</td>
                            </tr>
                            <tr>
                                <td>NIS/NISN</td>
                                <td class="tabelBiodataSuket">: {{ $suratKeterangan->nis }} / {{ $suratKeterangan->nisn }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas" colspan="2" style="padding-bottom: 20px;">
                    {{ $suratKeterangan->menerangkan }}
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas" colspan="2">
                    {{ $suratKeterangan->keperluan }}
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas" colspan="2" style="padding-top: 50px;">
                    <table style="width:100%;">
                        <tr>
                            <td style="width:50%;"></td>
                            <td>
                                <div style="margin-bottom: 70px;">
                                    Pekalongan, {{ \Carbon\Carbon::parse($suratKeterangan->tanggal_surat)->locale('id')->translatedFormat("d F Y") }}<br>
                                    {{ $suratKeterangan->pejabat }} <br>
                                </div>
                                <div>
                                    {{ strtoupper($suratKeterangan->nama_pejabat) }} <br>
                                    NIP.{{ $suratKeterangan->nip_pejabat }} <br>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
