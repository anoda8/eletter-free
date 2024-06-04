<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Tugas</title>
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
        .boxJudulSurGas{
            text-align: center;
            padding-top: 40px;
        }
        .judulSurGas{
            font-weight: bold;
            font-size: 17px;
        }
        .nomorSurGas{
            font-weight: 16px;
            font-weight: bold;
        }
        .topParagraph{
            padding-top: 30px;
        }
        .paragraphSurGas ol li{
            line-height: 1.5;
            justify-content:
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
                <td class="boxJudulSurGas" colspan="2">
                    <div class="judulSurGas">SURAT PENUGASAN</div>
                    <div class="nomorSurGas">Nomor :
                        {{ $suratTugas->suratKeluar->klasifikasi->kode }} &nbsp; / &nbsp;
                        {!! $suratTugas->suratKeluar->nomor_agenda == '-' ? '&nbsp;': $suratTugas->suratKeluar->nomor_agenda !!}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas topParagraph" colspan="2">
                    <ol>
                        <li style="text-align: justify;">Dasar : {{ $suratTugas->dasar_asal }}, {{ $suratTugas->dasar_nomor != '-' ? "nomor : ".$suratTugas->dasar_nomor.',' : '' }} tanggal : {{ \Carbon\Carbon::parse($suratTugas->dasar_tanggal)->locale('id')->translatedFormat("d F Y") }}, perihal : {{ $suratTugas->dasar_perihal }}.</li>
                        <li style="text-align: justify;">Menimbang : Bahwa untuk memenuhi hal tersebut, dipandang perlu Kepala SMA Negeri 3 Pekalongan menerbitkan Surat Tugas Kepada :</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="tabelYbs" id="tabelYbs">
                        <tbody>
                            <tr>
                                <td class="judulTabelYbs tdTabelYbs">NO</td>
                                <td class="judulTabelYbs tdTabelYbs">NAMA</td>
                                <td class="judulTabelYbs tdTabelYbs">NIP</td>
                                <td class="judulTabelYbs tdTabelYbs">PANGKAT/GOL</td>
                                <td class="judulTabelYbs tdTabelYbs">JABATAN</td>
                            </tr>
                            @foreach ($suratTugas->pegawai as $i => $tgsUser)
                            <tr>
                                <td class="tdTabelYbs isiTabelYbs textCenter">{{ $i+1 }}.</td>
                                <td class="tdTabelYbs isiTabelYbs" style="min-width:180px;">{{ $tgsUser->pegawai->gelar_depan != null ? $tgsUser->pegawai->gelar_depan : "" }}{{ $tgsUser->pegawai->nama }}{{ $tgsUser->pegawai->gelar_belakang != null ? ", ".$tgsUser->pegawai->gelar_belakang : "" }}</td>
                                <td class="tdTabelYbs isiTabelYbs textCenter">{{ $tgsUser->pegawai->nip }}</td>
                                <td class="tdTabelYbs isiTabelYbs textCenter">
                                    @if (!in_array($tgsUser->pegawai->pangkat_golongan_terakhir, [null, "-"]))
                                        {{ $data['pangkatGolongan'][$tgsUser->pegawai->pangkat_golongan_terakhir] }} /
                                        {{ $tgsUser->pegawai->pangkat_golongan_terakhir }}
                                    @endif
                                </td>
                                <td class="tdTabelYbs isiTabelYbs" style="min-width:180px;">
                                    {{ $tgsUser->jabatan->jabatan->nama_jabatan }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas" colspan="2">
                    <ol start="3">
                        <li>{{ $suratTugas->kegiatan }} pada :
                            <table class="tabelWaktuTempat" style="margin-top: 10px;">
                                <tr>
                                    <td style="padding-right: 10px;width: 100px;vertical-align:top;">Hari, Tanggal </td>
                                    <td style="vertical-align:top;">:</td>
                                    <td style="padding-left: 10px;">
                                        @if ($suratTugas->tanggal_mulai == $suratTugas->tanggal_selesai)
                                            {{ \Carbon\Carbon::parse($suratTugas->tanggal_mulai)->locale('id')->translatedFormat("l, d F Y") }}
                                        @else
                                            {{ \Carbon\Carbon::parse($suratTugas->tanggal_mulai)->locale('id')->translatedFormat("l") }} s.d.
                                            {{ \Carbon\Carbon::parse($suratTugas->tanggal_selesai)->locale('id')->translatedFormat("l") }},
                                            {{ \Carbon\Carbon::parse($suratTugas->tanggal_mulai)->locale('id')->translatedFormat("d F") }} s.d.
                                            {{ \Carbon\Carbon::parse($suratTugas->tanggal_selesai)->locale('id')->translatedFormat("d F Y") }},
                                        @endif
                                    </td>
                                </tr>
                                @if ($suratTugas->waktu != null)
                                    <tr>
                                        <td style="vertical-align:top;">Waktu </td>
                                        <td style="vertical-align:top;">:</td>
                                        <td style="padding-left:10px;">
                                            {{ \Carbon\Carbon::parse($suratTugas->waktu)->format("H:i") }} WIB
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="vertical-align:top;">Tempat </td>
                                    <td style="vertical-align:top;">:</td>
                                    <td style="padding-left:10px;">
                                        {{ $suratTugas->tempat_kegiatan }} <br>
                                        {{ $suratTugas->alamat_kegiatan }}
                                    </td>
                                </tr>
                            </table>
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas" colspan="2" style="padding-left: 20px;text-align:justify;">
                    Demikian surat penugasan  ini disampaikan kepada yang bersangkutan untuk dilaksanakan dengan sebaik-baiknya dan penuh tanggung jawab serta menyampaikan laporan setelah selesai melaksanakan tugas.
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas" colspan="2" style="padding-top: 50px;">
                    <table style="width:100%;">
                        <tr>
                            <td style="width:50%;"></td>
                            <td class="textCenter">
                                <div style="margin-bottom: 70px;">
                                    Pekalongan, {{ \Carbon\Carbon::parse($suratTugas->tanggal_surat)->locale('id')->translatedFormat("d F Y") }}<br>
                                    {{ $suratTugas->pejabat }} <br>
                                </div>
                                <div>
                                    {{ strtoupper($suratTugas->nama_pejabat) }} <br>
                                    NIP.{{ $suratTugas->nip_pejabat }} <br>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="paragraphSurGas" colspan="2" style="padding-top: 50px;">
                    <div style="margin-bottom: 40px;">
                        Diterima <br>
                        Tanggal : <br>
                    </div>
                    <div>
                        ..........................
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="page_break"></div>
    <div class="judulSppd">
        <a class="textJudulSppd">
            DAFTAR TEMPAT TUJUAN
        </a>
    </div>
    <table class="tabelSppd">
        <tbody>
            <tr>
                <td class="tabelSppdTrTd" style="width:48%">&nbsp;</td>
                <td class="tabelSppdTrTd">&nbsp;</td>
                <td class="tabelSppdTrTd" style="width:48%">
                    <ol type="I">
                        <li>
                            <div style="margin-bottom: 60px;">
                                Berangkat Dari <br>
                                Tempat Kedudukan <br>
                                {{ $suratTugas->pejabat }}
                            </div>
                            <div>
                                {{ $suratTugas->nama_pejabat }} <br>
                                NIP.{{ $suratTugas->nip_pejabat }}
                            </div>
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td class="tabelSppdTrTd" style="width:48%">
                    <ol type="I" start="2">
                        <li>
                            <div style="margin-bottom: 70px;">
                                Tiba di {{ $suratTugas->tempat_kegiatan }}<br>
                                Pada Tanggal : {{ \Carbon\Carbon::parse($suratTugas->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}<br>
                                Kepala
                            </div>
                        </li>
                    </ol>
                </td>
                <td class="tabelSppdTrTd">&nbsp;</td>
                <td class="tabelSppdTrTd" style="width:48%">
                    <div style="margin-bottom: 70px;margin-left:20px;margin-top:20px;">
                        Berangkat dari {{ $suratTugas->tempat_kegiatan }}<br>
                        <table>
                            <tr>
                                <td>Ke</td>
                                <td>:</td>
                                <td>SMA Negeri 3 Pekalongan</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($suratTugas->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Kepala</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tabelSppdTrTd" style="width:48%">
                    <ol type="I" start="3">
                        <li>
                            <div style="margin-bottom: 70px;">
                                Tiba di  <br>
                                Pada Tanggal : <br>
                                Kepala
                            </div>
                        </li>
                    </ol>
                </td>
                <td class="tabelSppdTrTd">&nbsp;</td>
                <td class="tabelSppdTrTd" style="width:48%">
                    <div style="margin-bottom: 70px;margin-left:20px;margin-top:20px;">
                        Berangkat dari  <br>
                        <table>
                            <tr>
                                <td>Ke</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kepala</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tabelSppdTrTd" style="width:48%">
                    <ol type="I" start="4">
                        <li>
                            <div style="margin-bottom: 70px;">
                                Tiba di  <br>
                                Pada Tanggal : <br>
                                Kepala
                            </div>
                        </li>
                    </ol>
                </td>
                <td class="tabelSppdTrTd">&nbsp;</td>
                <td class="tabelSppdTrTd" style="width:48%">
                    <div style="margin-bottom: 70px;margin-left:20px;margin-top:20px;">
                        Berangkat dari  <br>
                        <table>
                            <tr>
                                <td>Ke</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kepala</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tabelSppdTrTd" style="width:48%">
                    <ol type="I" start="5">
                        <li>
                            <div style="margin-bottom: 60px;">
                                <table>
                                    <tr>
                                        <td>Tiba di</td>
                                        <td>:</td>
                                        <td> SMA Negeri 3 Pekalongan</td>
                                    </tr>
                                    <tr>
                                        <td>Pada Tanggal</td>
                                        <td>:</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($suratTugas->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kepala</td>
                                        <td>:</td>
                                        <td> SMA Negeri 3 Pekalongan</td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                {{ $suratTugas->nama_pejabat }} <br>
                                NIP.{{ $suratTugas->nip_pejabat }}
                            </div>
                        </li>
                    </ol>
                </td>
                <td class="tabelSppdTrTd">&nbsp;</td>
                <td class="tabelSppdTrTd" style="width:48%">
                    <div style="margin-bottom: 60px;margin-left:20px;margin-top:20px;">
                        <div style="margin-bottom: 60px;">
                            Mengetahui : <br>
                            Pemberi Tugas <br><br>
                            {{ $suratTugas->pejabat }}
                        </div>
                        <div>
                            {{ $suratTugas->nama_pejabat }} <br>
                            NIP.{{ $suratTugas->nip_pejabat }}
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>

