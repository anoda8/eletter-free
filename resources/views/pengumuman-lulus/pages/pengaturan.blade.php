<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Setting Pengumuman Kelulusan</h5>
                </div>
                <div class="card-body">
                    <a class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPengaturan">
                        <svg class="nav-icon" style="width:15px;height:15px;">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                        </svg>
                        Tambah Pengaturan
                    </a>
                    <livewire:pengumuman-lulus.tables.tabel-pengaturan />
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalTambahPengaturan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTambahPengaturan" aria-hidden="true">
        <form method="POST" wire:submit="simpanPengaturan">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPengaturan">Tambah Setting Kelulusan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Pengumuman</label>
                            <input type="date" class="form-control" wire:model="tanggal" aria-describedby="helpId" placeholder="">
                            @error('tanggal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Waktu Pengumuman</label>
                            <input type="time" class="form-control" wire:model="waktu" aria-describedby="helpId" placeholder="">
                            @error('waktu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
