<div>
    {{-- Stop trying to control. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">{{ $gtk->nama }}</h5>
            <a class="btn btn-secondary btn-sm" href="/referensi/data-gtk" role="button">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-left') }}"></use>
                </svg>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-secondary table-hover table-striped">
                    <tbody>
                        <tr>
                            <th style="width:250px;">Nama PTK</th>
                            <td style="width:5px;">:</td>
                            <td>{{ $gtk->nama ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>:</td>
                            <td>{{ $gtk->jenis_kelamin ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>:</td>
                            <td>{{ $gtk->tempat_lahir ?? "-" }}, {{ $gtk->tanggal_lahir ? \Carbon\Carbon::parse($gtk->tanggal_lahir)->locale('id')->translatedFormat("d F Y") : "-" }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>:</td>
                            <td>{{ $gtk->agama_id_str ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>:</td>
                            <td>{{ $gtk->nip ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>:</td>
                            <td>{{ $gtk->nik ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>NUPTK</th>
                            <td>:</td>
                            <td>{{ $gtk->nuptk ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>:</td>
                            <td>{{ $gtk->jenis_ptk_id_str ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Status Kepegawaian</th>
                            <td>:</td>
                            <td>{{ $gtk->status_kepegawaian_id_str ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Pendidikan Terakhir</th>
                            <td>:</td>
                            <td>{{ $gtk->pendidikan_terakhir ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Bidang Studi Pendidikan</th>
                            <td>:</td>
                            <td>{{ $gtk->bidang_studi_terakhir ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Pangkat Golongan Terkhir</th>
                            <td>:</td>
                            <td>{{ $gtk->pangkat_golongan_terakhir ?? "-" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Riwayat Pendidikan Formal</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-secondary table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Satuan Pendidikan</th>
                            <th class="text-center">Masuk</th>
                            <th class="text-center">Lulus</th>
                            <th class="text-center">Jenjang</th>
                            <th class="text-center">Gelar Akademik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gtk->rwyPendidikanFormal->sortBy('tahun_masuk') as $pendFormal)
                            <tr>
                                <td scope="row">{{ $pendFormal->satuan_pendidikan_formal }}</td>
                                <td class="text-center">{{ $pendFormal->tahun_masuk }}</td>
                                <td class="text-center">{{ $pendFormal->tahun_lulus }}</td>
                                <td class="text-center">{{ $pendFormal->jenjang_pendidikan_id_str }}</td>
                                <td>{{ $pendFormal->gelar_akademik_id_str }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Riwayat Kepangkatan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-primary table-secondary table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Pangkat/Golongan</th>
                            <th scope="col">Nomor SK</th>
                            <th scope="col">Tanggal SK</th>
                            <th scope="col">TMT Pangkat</th>
                            <th scope="col">Masa Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gtk->rwyKepangkatan->sortBy('tanggal_sk') as $kepangkatan)
                            <tr class="">
                                <td scope="row">{{ $kepangkatan->pangkat_golongan_id_str }}</td>
                                <td scope="row">{{ $kepangkatan->nomor_sk }}</td>
                                <td scope="row">{{ $kepangkatan->tanggal_sk }}</td>
                                <td scope="row">{{ $kepangkatan->tmt_pangkat }}</td>
                                <td scope="row">{{ $kepangkatan->masa_kerja_gol_bulan }} bulan, {{ $kepangkatan->masa_kerja_gol_tahun }} tahun</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
