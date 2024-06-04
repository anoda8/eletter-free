<div>
    @isset ( $viewLink )
        <div class="text-center">
            <button class="btn btn-info btn-sm" wire:click="gantiUrutan('{{ $viewLink }}')" title="Ganti Urutan" data-bs-toggle="modal" data-bs-target="#modalGantiUrutan">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-clear-all') }}"></use>
                </svg>
                Urutkan
            </button>
        </div>
    @endif
</div>
