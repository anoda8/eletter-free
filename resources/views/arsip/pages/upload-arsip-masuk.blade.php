<div>
    {{-- The whole world belongs to you. --}}
    <div class="card mb-3">
        <form wire:submit="uploadFile">
            <div class="card-header">
                <h5 class="fw-bold">Unggah Surat Masuk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Perihal</label>
                            <textarea class="form-control" wire:model="perihal" rows="2"></textarea>
                        </div>
                        @error('perihal') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="mb-3">
                            <label class="form-label fw-bold">Berkas</label>
                            <div class="input-group">
                                <input type="file" class="form-control" wire:model="file" aria-describedby="fileSurmas" aria-label="Upload">
                                <button class="btn btn-outline-success fw-bold" type="submit" id="fileSurmas">
                                    <svg class="nav-icon" style="width:15px;height:15px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                                    </svg>
                                    Upload
                                </button>
                            </div>
                        </div>
                        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                        @if ($uploaded == true)
                            <div class="alert alert-success" role="alert">
                                <strong>{{ $perihalTerupload }}</strong>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary" href="/arsip/input-arsip-masuk/{{ $fileArsipId }}" role="button">
                                    Lanjut
                                    <svg class="nav-icon" style="width:15px;height:15px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-right') }}"></use>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-seondary table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Perihal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listFileArsip as $key => $file)
                                    <tr>
                                        <td>{{ $file->perihal }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-success btn-sm" href="/arsip/input-arsip-masuk/{{ $file->id }}" role="button">Proses</a>&nbsp;
                                            <a class="btn btn-danger btn-sm" wire:click="pilihFileDihapus('{{ $file->id }}')" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiHapus" role="button">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalKonfirmasiHapus" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalKonfirmasiHapus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiHapus">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus {{ $fileDihapus == null ? "...Loading" : $fileDihapus->perihal }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-danger" wire:click="hapusFile">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
