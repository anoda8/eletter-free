<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-bold">Detail Surat Keluar</h5>
                    <div>
                        <a class="btn btn-info btn-sm {{ (auth()->user()->isAbleTo('update-berkas-arsip') || $owner) ? "" : "disabled" }}" role="button" data-bs-toggle="modal" data-bs-target="#modalEditDetail">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                            </svg>
                        </a>
                        <a class="btn btn-secondary btn-sm" href="/arsip/arsip-keluar" role="button">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
                            </svg>
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold border-bottom">Perihal</label>
                        <div>{{ $arsipKeluar->perihal }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold border-bottom">Nomor Surat</label>
                        <div>{{ $arsipKeluar->klasifikasi->kode }} / {{ $arsipKeluar->nomor_agenda }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold border-bottom">Tanggal Surat</label>
                        <div>{{ \Carbon\Carbon::parse($arsipKeluar->tanggal_surat)->locale('id')->translatedFormat("l, d F Y") }}</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" class="btn btn-sm btn-primary {{ $arsipKeluar->status < 2 ? "disabled" : "" }}" href="{{ config('app.url') }}/storage/arsip/{{ $createdAt->year }}/surat-keluar/{{ $createdAt->locale('id')->translatedFormat("F") }}/{{ $arsipKeluar->id }}.pdf" role="button">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-file') }}"></use>
                                </svg>
                                Download Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="col">
                        <label class="form-label fw-bold">Author</label>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" wire:model.change="author" {{ auth()->user()->isAbleTo('tagihan-arsip') ? "" : "disabled" }}>
                            @foreach ($listPegawai as $pegawai)
                                <option value="{{ $pegawai->user?->id }}">{{ $pegawai->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (auth()->user()->isAbleTo('tagihan-arsip'))
                        @if ($arsipKeluar->file == null)
                            <a class="btn btn-warning btn-sm" wire:click="kirimTagihan" role="button">Kirim Tagihan</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-bold">Laporan / Dokumentasi</h5>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-bold">Dokumen</h5>
                    <button class="btn btn-success btn-sm {{ (auth()->user()->isAbleTo('update-berkas-arsip') || $owner) ? "" : "disabled" }}" data-bs-toggle="modal" data-bs-target="#modalUploadArsip" role="button">
                        <svg class="nav-icon" style="width:15px;height:15px;">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                        </svg>
                        Unggah Berkas
                    </button>
                </div>
                <div class="card-body">
                    @if ($arsipKeluar->file != null)
                        <object data="{{ config('app.url') }}/storage/arsip/{{ $createdAt->year }}/surat-keluar/{{ $createdAt->locale('id')->translatedFormat("F") }}/{{ $arsipKeluar->id }}.pdf" style="width:100%;height:700px;"></object>
                    @else
                        <div class="alert alert-warning" role="alert">
                          <h4 class="alert-heading">Kosong</h4>
                          <p>Belum ada file arsip</p>
                          <hr>
                          <p class="mb-0">Silahkan upload berkas arsip</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modalEditDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <form method="POST" wire:submit="simpanDetailSuratKeluar">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalTitleId">Edit Surat Keluar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Surat</label>
                            <input type="date" wire:model="tanggalSurat" class="form-control" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kode Klasifikasi</label>
                            <input type="text" wire:model.live="kodeKlasifikasi" list="listKodeKlasifikasi" class="form-control" aria-describedby="helpId" placeholder="">
                        </div>
                        <datalist id="listKodeKlasifikasi">
                            @foreach ($listKodeKlasifikasi as $klasifikasi)
                                <option value="{{ $klasifikasi->kode }} - {{ $klasifikasi->klasifikasi }}">
                            @endforeach
                        </datalist>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Perihal</label>
                            <input type="text" wire:model="perihal" class="form-control" aria-describedby="helpId" placeholder="">
                            @error('perihal')
                                <div class="text-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalUploadArsip" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalUploadBerkas" aria-hidden="true">
        <form method="POST" wire:submit="doUploadBerkas" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUploadBerkas">Unggah Berkas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Unggah berkas Arsip Keluar</label>
                            <input class="form-control" wire:model="berkasUpload" type="file" id="formFile">
                            @error('berkasUpload')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success">Unggah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
