<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="img-responsive">
                @if ($enabled)
                    <img src="/images/congrate.png" alt="" class="img-fluid">
                @else
                    <img src="/images/waiting.png" alt="" class="img-fluid">
                @endif
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Detail Siswa</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control" value="{{ $pengLulus->siswa->nama }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIS</label>
                        <input type="text" class="form-control" value="{{ $pengLulus->siswa->nipd }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">NISN</label>
                        <input type="text" class="form-control" value="{{ $pengLulus->siswa->nisn }}" readonly>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Pengumuman Kelulusan</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a type="button" target="_blank" href="{{ config('app.url') }}/storage/pengumuman-lulus/sk/{{ $settingPengumuman->tahun }}/{{ $settingPengumuman->id }}.pdf" class="btn btn-info {{ $enabled == true ? "" : "disabled" }}">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-download') }}"></use>
                            </svg>
                            <i class="fw-bold">Unduh SK Kelulusan</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Surat Keterangan Lulus</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        <strong>Pesan</strong> Surat Keterangan Lulus secara resmi akan dibagikan kepada Orang Tua/Wali Kelas XII pada waktu yang di tentukan.
                    </div>

                    @if ($pengLulus->status > 0)
                        @if ($enabled == true)
                            <object data="{{ config('app.url') }}/storage/pengumuman-lulus/{{ $pengLulus->tahun }}/{{ $pengLulus->id }}.pdf" style="width:100%;height:700px;"></object>
                        @else
                            <div class="alert alert-warning" role="alert">
                            <p>Waktu pengumuman hari{{ \Carbon\Carbon::parse($settingPengumuman->waktu_pengumuman)->locale('id')->translatedFormat('l, d F Y, H:i') }}</p>
                            <hr>
                            <p class="mb-0">Silahkan hubungi operator</p>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Kosong</h4>
                        <p>File surat keterangan Lulus Belum diunggah oleh Administrator</p>
                        <hr>
                        <p class="mb-0">Silahkan hubungi operator</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}
</div>
