<div>
    {{-- Be like water. --}}
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between">
            <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahSiswaLulus" role="button">
                <svg class="nav-icon" style="width:15px;height:15px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                </svg>
                Tambah Siswa Lulus
            </a>
            <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalBatchUpload" role="button">
                <svg class="nav-icon" style="width:15px;height:15px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                </svg>
                Batch Upload
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-body">
                    <livewire:pengumuman-lulus.tables.tabel-pengumuman-lulus />
                </div>
            </div>

        </div>
    </div>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalTambahSiswaLulus" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTambahSiswaLulus" aria-hidden="true">
        <form method="POST" wire:submit="tambahKelas">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahSiswaLulus">Tambah Siswa Lulus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Pilih Kelas</label>
                            <select class="form-select" wire:model="kelasTambah">
                                <option value="">- Pilih Kelas -</option>
                                @foreach ($listKelas as $kelas)
                                    <option value="{{ $kelas->nama_rombel }}">{{ $kelas->nama_rombel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-success">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                            </svg>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalBatchUpload" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalBatchUpload" aria-hidden="true">
        <form wire:submit="uploadFile" method="POST">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBatchUpload">Upload Surat Keterangan Lulus/SKHU</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" wire:model="fileSurkel" multiple>
                        @error('fileSurkel.*') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalBatchUpload'), options)

    </script>
</div>
