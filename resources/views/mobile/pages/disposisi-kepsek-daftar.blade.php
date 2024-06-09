<div>
    {{-- In work, do what you enjoy. --}}
    <div class="card mb-5">
        <div class="card-header">
            <h5 class="fw-bold">Daftar Surat Masuk</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="mb-3">
                    <select class="form-select" wire:model.change="status">
                        <option value="">- Pilih Status -</option>
                        <option value="0">Surat Baru</option>
                        <option value="1">Disposisi</option>
                    </select>
                </div>
                {{ $suratMasuk->links('livewire::simple-bootstrap') }}
            </div>
            @foreach ($suratMasuk as $srtMasuk)
                <ul class="list-group mb-2" wire:click="gotoDetail('{{ $srtMasuk->id }}')">
                    <li class="list-group-item {{ $status == 0 ? "list-group-item-success" : ""}} list-group-item-action cur-pointer">
                        <span class="fw-bold">{{ $srtMasuk->asal_surat }}</span>
                        <div>{{ $srtMasuk->perihal }}</div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
</div>
