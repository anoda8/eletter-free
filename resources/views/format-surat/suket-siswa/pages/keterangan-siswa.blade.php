<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card">
        <div class="card-header">
            <h5 class="fw-bold">Surat Keterangan Siswa</h5>
        </div>
        <div class="card-body">
            <a class="btn btn-success btn-sm mb-3" href="{{ route('format.detail-keterangan-siswa') }}" role="button">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                </svg>
                Tambah
            </a>
            <livewire:format-surat.suket-siswa.tables.tabel-suket-siswa />
        </div>
    </div>
</div>
