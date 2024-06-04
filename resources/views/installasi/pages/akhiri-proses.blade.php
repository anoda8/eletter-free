<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row mb-4 mt-2">
        <div class="col-md-12 d-flex justify-content-start">
            <a class="btn btn-primary" href="{{ route('installasi.mode-dapodik') }}" role="button">
                <svg class="icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
                </svg>
                Kembali
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pt-5 pb-5 text-center">
            <a wire:click="akhiriInstallasi" class="btn btn-danger" role="button">Akhiri Installasi</a>
        </div>
    </div>

</div>
