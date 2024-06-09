<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="fw-bold">Daftar Pesan Terkirim</h5>
            <a class="btn btn-secondary btn-sm" href="/whatsapp/kirim-pesan-wa" role="button" wire:navigate>
                <svg class="nav-icon" style="width:15px;height:15px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
                </svg>
            </a>
        </div>
        <div class="card-body">
            <livewire:whatsapp.table.tabel-whatsapp-terkirim lazy />
        </div>
    </div>
</div>
