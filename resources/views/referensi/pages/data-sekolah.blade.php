<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card text-start">
        <div class="card-header">
            <h5 class="fw-bold">Referensi Data Sekolah</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-secondary table-hover table-striped">
                    <tbody>
                        <tr>
                            <th style="width:200px;">Nama Sekolah</th>
                            <td style="width:5px;">:</td>
                            <td>{{ $dtSekolah->nama ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>NSS</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->nss ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>NPSN</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->npsn ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Bentuk Pendidikan</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->bentuk_pendidikan_id_str ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Status Sekolah</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->status_sekolah_str ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Jalan</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->alamat_jalan ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>RT/RW</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->rt ?? "-" }} / {{ $dtSekolah->rw ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Kode Pos</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->kode_pos ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Telp / Fax</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->nomor_telepon ?? "-" }} / {{ $dtSekolah->nomor_fax ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>:</td>
                            <td>
                                <a href="{{ $dtSekolah->website ?? "-" }}" target="_blank">{{ $dtSekolah->website ?? "-" }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Dusun / Desa Kelurahan</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->dusun ?? "-" }} / {{ $dtSekolah->desa_kelurahan ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->kecamatan ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Kabupaten / Kota</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->kabupaten_kota ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Provinsi</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->provinsi ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Lintang / Bujur</th>
                            <td>:</td>
                            <td>{{ $dtSekolah->lintang ?? "-" }} / {{ $dtSekolah->bujur ?? "-" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
