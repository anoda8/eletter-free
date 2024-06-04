<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="card">
        <div class="card-header">
            <h5>Surat Tugas</h5>
        </div>
        <div class="card-body">
            <a class="btn btn-success btn-sm mb-4" href="{{ route('format.tambah-surat-tugas') }}" role="button">
                <svg class="nav-icon" style="width:15px;height:15px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                </svg>
                Buat Surat Tugas
            </a>
            <livewire:format-surat.tables.tabel-surat-tugas lazy />
        </div>
    </div>
</div>
