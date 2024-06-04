<div>
    {{-- Do your work, then step back. --}}
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahIzin">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                </svg>
                Tambah Izin
            </button>
            <hr>
            <livewire:izin-akses.table.tabel-permission />
        </div>
    </div>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalTambahIzin" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTambahIzin" aria-hidden="true">
        <form method="POST" wire:submit="simpanTambahIzin">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahIzin">Tambah Izin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name/Code</label>
                            <input type="text" class="form-control" wire:model="name" aria-describedby="helpId" placeholder="" readonly />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Display Name</label>
                            <input type="text" class="form-control" wire:model.live="displayName" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <input type="text" class="form-control" wire:model="description" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
