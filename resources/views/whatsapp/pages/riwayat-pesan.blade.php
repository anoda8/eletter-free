<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="fw-bold">Riwayat Pesan Whatsapp</h5>
                </div>
                <div class="card-body">
                    @if (auth()->user()->hasRole(['administrator', 'super']))
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a data-bs-toggle="modal" data-bs-target="#modalKonfirmasiBersihkanLog" class="btn btn-danger btn-sm" role="button">Bersihkan Log</a>
                            </div>
                        </div>
                    @endif
                    <livewire:whatsapp.table.tabel-riwayat-pesan />
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalKonfirmasiBersihkanLog" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalKonfirmasiBersihkanLog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiBersihkanLog">Konfirmasi Bersihkan Log</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan membersihkan log pesan ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-danger" wire:click="clearLog">Bersihkan</button>
                </div>
            </div>
        </div>
    </div>
</div>
