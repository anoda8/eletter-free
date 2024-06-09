<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="card">
        <div class="card-header">
            <h5 class="fw-bold">Biodata Siswa</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-2">
                <a class="btn btn-primary btn-sm" role="button" wire:click="importDtReferensi">Update Data Referensi</a>
            </div>
            <livewire:databases.tables.tabel-biodata-siswa lazy />
        </div>
    </div>
</div>
