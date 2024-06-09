<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="fw-bold">Detail Pengumuman</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun</label>
                        <input type="text" class="form-control" value="{{ $setPengLulus->tahun }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="text" class="form-control cur-pointer" value="{{ \Carbon\Carbon::parse($setPengLulus->waktu_pengumuman)->locale('id')->translatedFormat('l, d F Y H:i') }}" readonly data-bs-toggle="modal" data-bs-target="#modalGantiTanggal">
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="fw-bold">Pengumuman Kelulusan</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalUpload" class="btn btn-info">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                            </svg>
                            <i class="fw-bold">Upload SK</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="fw-bold">Surat Keterangan Lulus</h5>
                </div>
                <div class="card-body">
                    @if ($setPengLulus->ada_sk)
                        <object data="{{ config('app.url') }}/storage/pengumuman-lulus/sk/{{ $setPengLulus->tahun }}/{{ $setPengLulus->id }}.pdf" style="width:100%;height:700px;"></object>
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
    </div>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalUpload" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalUpload" aria-hidden="true">
        <form method="POST" wire:submit="uploadSk">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalUpload">Unggah SK</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" wire:model="fileSk">
                        @error('fileSk') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalGantiTanggal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalGantiTanggal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalGantiTanggal">Ganti Waktu Pengumuman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Ganti Tanggal</label>
                        <input type="text" class="form-control" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Waktu</label>
                        <input type="text" class="form-control" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
