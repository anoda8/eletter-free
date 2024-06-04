<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-bold">Detail Surat Masuk</h5>
                    <div>
                        <a class="btn btn-info btn-sm {{ auth()->user()->isAbleTo('update-berkas-arsip') ? "" : "disabled" }}" role="button" data-bs-toggle="modal" data-bs-target="#modalEditDetail">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                            </svg>
                        </a>
                        <a class="btn btn-secondary btn-sm" href="/arsip/arsip-masuk" role="button">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-bold border-bottom">Nomor Agenda</label>
                                <div>{{ $arsipMasuk->klasifikasi->kode }} / {{ $arsipMasuk->nomor_agenda }}</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-bold border-bottom">Tanggal Surat</label>
                                <div>{{ \Carbon\Carbon::parse($arsipMasuk->tanggal_surat)->locale('id')->translatedFormat("d F Y") }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold border-bottom">Asal Surat</label>
                        <div>{{ $arsipMasuk->asal_surat }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold border-bottom">Perihal</label>
                        <div>{{ $arsipMasuk->perihal }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold border-bottom">Nomor Surat</label>
                        <div>{{ $arsipMasuk->nomor_surat }}</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" class="btn btn-sm btn-primary {{ $arsipMasuk->status != null ? "" : "disabled"}}" href="{{ config('app.url') }}/storage/arsip/{{ $createdAt->year }}/surat-masuk/{{ $createdAt->locale('id')->translatedFormat("F") }}/{{ $arsipMasuk->id }}.pdf" role="button">
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
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-bold">Disposisi</h5>
                    <div>
                        @if ($arsipMasuk->status < 1)
                        <a class="btn btn-sm btn-warning {{ auth()->user()->isAbleTo('update-berkas-arsip') ? "" : "disabled" }}" title="Kirim Disposisi Kepsek" wire:click="kirimUlangDisposisi" role="button">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-closed') }}"></use>
                            </svg>
                        </a>
                        @endif
                        <a class="btn btn-sm btn-secondary {{ auth()->user()->isAbleTo('update-berkas-arsip') ? "" : "disabled" }}" title="Backup Disposisi" wire:click="saveDisposisi('{{ $arsipMasuk->id }}')" role="button">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                            </svg>
                        </a>
                        <a title="Cetak Disposisi" class="btn btn-sm {{ (($arsipMasuk->status == 0) || (!auth()->user()->isAbleTo('cetak-berkas-arsip'))) ? 'disabled btn-secondary' : 'btn-outline-info' }}" href="/arsip/disposisi-arsip-masuk-cetak/{{ $arsipMasuk->id }}" target="_blank" role="button">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-print') }}"></use>
                            </svg>
                            Cetak
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($arsipMasuk->status > 0)
                        <div class="mb-3">
                            <label class="fw-bold">Disposisi Ke</label>
                            @foreach ($arsipMasuk->disposisi as $disposisi)
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-action list-group-item-{{ $disposisi->diterima == null ? "danger" : "success" }}">
                                        <span class="fw-bold">{{ $disposisi->pegawai->nama }} @if ($disposisi->jabatan != null) [{{ $disposisi->jabatan?->nama_jabatan }}] @endif </span><br>
                                        {{ \Carbon\Carbon::parse(($disposisi->diterima != null ? $disposisi->diterima : $disposisi->terkirim))->format("d/m/Y H:i") }}
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Catatan Disposisi</label>
                            <div>
                                @foreach ($catatan as $cttn)
                                    - {{ $cttn->catatan }}, <br>
                                @endforeach
                            </div>
                        </div>
                        @if ($arsipMasuk->catatan_tambahan != null)
                        <div class="mb-3">
                            <label class="fw-bold">Tambahan Catatan</label>
                            <div>
                                - {{ $arsipMasuk->catatan_tambahan }}
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="alert alert-warning" role="alert">
                            <strong>Belum Ada Disposisi</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-bold">Dokumen</h5>
                    <div>
                        @if ($arsipMasuk->status != 9)
                            <a class="btn btn-danger btn-sm {{ auth()->user()->isAbleTo('hapus-berkas-arsip') ? "" : "disabled" }}"" role="button" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiHapusArsip">
                                <svg class="nav-icon" style="width:15px;height:15px;">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-trash') }}"></use>
                                </svg>
                            </a>
                        @else
                            <a class="btn btn-info btn-sm {{ auth()->user()->isAbleTo('hapus-berkas-arsip') ? "" : "disabled" }}"" role="button" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRestoreArsip">
                                <svg class="nav-icon" style="width:15px;height:15px;">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-reload') }}"></use>
                                </svg>
                            </a>
                        @endif
                        <button class="btn btn-success btn-sm {{ auth()->user()->isAbleTo('update-berkas-arsip') ? "" : "disabled" }}" data-bs-toggle="modal" data-bs-target="#modalUploadArsip" role="button">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                            </svg>
                            Unggah Berkas
                        </button>
                    </div>

                </div>
                <div class="card-body">
                    @if (($arsipMasuk->status > 0) || ($arsipMasuk->file?->count() > 0))
                        <object data="{{ config('app.url') }}/storage/arsip/{{ $createdAt->year }}/surat-masuk/{{ $createdAt->locale('id')->translatedFormat("F") }}/{{ $arsipMasuk->id }}.pdf" style="width:100%;height:700px;"></object>
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

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalEditDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <form method="POST" wire:submit="simpanDetailSuratMasuk">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalTitleId">Edit Surat Masuk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Surat</label>
                            <input type="date" wire:model="tanggalSurat" class="form-control" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Asal Surat</label>
                            <input type="text" wire:model="asalSurat" class="form-control" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Perihal</label>
                            <input type="text" wire:model="perihal" class="form-control" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor Klasifikasi</label>
                            <input type="text" wire:model.live="klasifikasi" list="listKlasifikasi" class="form-control" aria-describedby="helpId" placeholder="">
                            <datalist id="listKlasifikasi">
                                @foreach ($listKlasifikasi as $klasifikasi)
                                    <option value="{{ $klasifikasi->kode }} - {{ $klasifikasi->klasifikasi }}">
                                @endforeach
                            </datalist>
                            @error('klasifikasi')
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
    <div wire:ignore.self class="modal fade" id="modalUploadArsip" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalUploadArsip" aria-hidden="true">
        <form method="POST" wire:submit="uploadBerkas" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUploadArsip">Unggah Berkas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Unggah berkas Arsip Masuk</label>
                            <input class="form-control" wire:model="berkasUpload" type="file" id="formFile">
                            @error('berkasUpload')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-success">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                            </svg>
                            Upload
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalKonfirmasiHapusArsip" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalKonfirmasiHapusArsip" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiHapusArsip">Modal Konfirmasi Hapus Arsip</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Surat masuk akan dihapus sebagai Arsip. Apakah anda yakin akan menghapusnya ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-sm btn-danger" wire:click="hapusArsip">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalKonfirmasiRestoreArsip" tabindex="-1"  data-bs-keyboard="false" role="dialog" aria-labelledby="modalKonfirmasiRestoreArsip" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiRestoreArsip">Konfirmasi Restore Arsip</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Surat masuk akan direstore dan diproses ulang. Apakah anda yakin ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-primary" wire:click="restoreArsip">Restore</button>
                </div>
            </div>
        </div>
    </div>
</div>
