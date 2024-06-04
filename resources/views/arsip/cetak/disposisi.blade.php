<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Disposisi Surat Masuk</title>
    <style>
        html {
            margin-top: 10px;
            margin-right:10px;
            margin-bottom:0;
            padding-right: 0;
            font-size: 15px;
        }
        .judulDindikbudjateng{
            font-size: 15px;
            font-weight: bold;
        }
        .judulSmagapekalongan{
            font-size: 18px;
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
        .text-center{
            text-align: center;
        }
        .first-border{
            border-top:solid 2px;
            border-bottom:solid 2px;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .bottom-border{
            border-bottom:solid 2px;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .right-border{
            border-right: solid 1px;
        }
        .outer-box{
            border: 2px solid;
        }
        .box-block{
            background-color: black;
        }
        .centang-box{
            border: solid 2px;
            width: 20px;
            height: 20px;
            margin-left: 30px;
            margin-right: 0;
        }
        .top{
            vertical-align: top;
        }

    </style>
</head>
<body>
    <div style="margin-left:50%;">
        <table class="outer-box">
            <tbody>
                @include('components.kop-surat-disposisi', ['kopSurat' => $data['kopSurat']])
                <tr>
                    <td colspan="2" class="text-center" style="padding-top: 10px;padding-bottom: 10px;">
                        <span class="judulDisposisi">LEMBAR DISPOSISI</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center first-border">
                        <table width="100%" padding="0">
                            <tr>
                                <td style="width:30px;">
                                    <div class="centang-box {{ $arsipMasuk->sifat_surat == 'rahasia' ? "box-block" : "" }}">&nbsp;</div>
                                </td>
                                <td><div>RAHASIA</div></td>
                                <td style="width:30px;">
                                    <div class="centang-box {{ $arsipMasuk->sifat_surat == 'penting' ? "box-block" : "" }}">&nbsp;</div>
                                </td>
                                <td>PENTING</td>
                                <td style="width:30px;">
                                    <div class="centang-box {{ $arsipMasuk->sifat_surat == 'rutin' ? "box-block" : "" }}">&nbsp;</div>
                                </td>
                                <td>RUTIN</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center bottom-border">
                        <table width="100%">
                            <tr>
                                <td style="width:100px;">Tanggal</td>
                                <td style="width:100px;">: {{ \Carbon\Carbon::parse($arsipMasuk->tanggal_diterima)->format("d/m/Y") }}</td>
                                <td></td>
                                <td style="width:140px;">Yang Menyelesaikan</td>
                                <td>:</td>
                            </tr>
                            <tr>
                                <td>Nomor Agenda</td>
                                <td>: {{ $arsipMasuk->nomor_agenda }}</td>
                                <td></td>
                                <td>Diselesaikan Tanggal</td>
                                <td>:</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center bottom-border">
                        <table width="100%">
                            <tr>
                                <td style="width:100px;">Asal Surat</td>
                                <td>: {{ $arsipMasuk->asal_surat }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal/Nomor</td>
                                <td>: {{ \Carbon\Carbon::parse($arsipMasuk->tanggal_surat)->format("d/m/Y") }} / {{ $arsipMasuk->nomor_surat }}</td>
                            </tr>
                            <tr>
                                <td class="top">Perihal</td>
                                <td class="top">: {{ $arsipMasuk->perihal }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center bottom-border">
                        <table style="margin-left: 5px;margin-right:5px;" class="bottom-border">
                            <tr>
                                <td class="top right-border" width="272px;">
                                    <b>Catatan :</b><br>
                                    @foreach (json_decode($arsipMasuk->catatan) as $catatan)
                                        @if ($catatan != null)
                                            - {{ \App\Models\SettingCatatanDisposisi::find($catatan)->catatan }} <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="top" width="300px;">
                                    <b>Tambahan Catatan :</b><br>
                                    {{ $arsipMasuk->catatan_tambahan }}
                                </td>
                            </tr>
                        </table>
                        <table class="table table-primary" width="80%">
                            <tbody>
                                <tr>
                                    <td class="right-border" style="font-weight: bold;">Disposisi Ke</td>
                                    <td class="right-border" style="font-weight: bold;">Terkirim</td>
                                    <td style="font-weight: bold;">Diterima</td>
                                </tr>
                                @if ($arsipMasuk->disposisi?->count() > 0)
                                    @foreach ($arsipMasuk->disposisi as $dsp)
                                        <tr>
                                            <td class="top">
                                                - {{ $dsp->pegawai->nama }} @if ($dsp->jabatan != null) [{{ $dsp->jabatan->nama_jabatan }}] @endif
                                            </td>
                                            <td class="top">
                                                @if ($dsp->terkirim != null) {{ \Carbon\Carbon::parse($dsp->terkirim)->format("d/m/y H:i") }} @endif
                                            </td>
                                            <td class="top">
                                                @if ($dsp->diterima != null) {{ \Carbon\Carbon::parse($dsp->diterima)->format("d/m/y H:i") }} @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center bottom-border">
                        <table width="100%">
                            <tr>
                                <td>
                                    Didisposisikan secara elektronik oleh : <br>
                                    Kepala {{ ucwords(strtolower($data['kopSurat']->nama_sekolah)) }} <br>
                                    Tanggal {{ \Carbon\Carbon::parse($arsipMasuk->tanggal_disposisi)->format("d/m/Y") }}
                                    pukul {{ \Carbon\Carbon::parse($arsipMasuk->tanggal_disposisi)->format("H:i") }}
                                </td>
                                <td class="top" style="width:20%;font-size:12px;text-align:right;">
                                    <img src="data:image/png;base64, {!! $data['qrcode'] !!}">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
