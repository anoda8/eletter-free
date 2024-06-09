<div>
    {{-- In work, do what you enjoy. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="fw-bold">Catatan Disposisi</h5>
            <button class="btn btn-success btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#modalTambahCatatan">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                </svg>
                Tambah Catatan
            </button>
        </div>
        <div class="card-body">
            <livewire:settings.tables.tabel-catatan-disposisi lazy />
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalTambahCatatan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTambahCatatan" aria-hidden="true">
        <form method="POST" wire:submit="simpanCatatan">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahCatatan">Tambah Catatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Isi Catatan</label>
                            <input type="text" wire:model="isiCatatan" class="form-control" aria-describedby="helpId" placeholder="Isi Catatan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" role="button" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
