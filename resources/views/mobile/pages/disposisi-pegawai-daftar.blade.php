<div>
    {{-- Stop trying to control. --}}
    <div class="card">
        <div class="card-header">
            <h5>Disposisi Surat Masuk</h5>
            <h6>{{ auth()->user()->name }}</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="mb-3">
                    <select class="form-select" wire:model.change="status" name="status">
                        <option value="">- Pilih Status -</option>
                        <option value="baru">Surat Baru</option>
                        <option value="dibaca">Dibaca</option>
                    </select>
                </div>
                {{ $disposisis->links('livewire::simple-bootstrap') }}
            </div>
            @foreach ($disposisis as $disposisi)
                <ul class="list-group mb-2">
                    <li class="list-group-item list-group-item-action list-group-item-warning cur-pointer" wire:click="gotoDetail('{{ $disposisi->surat->id }}')">
                        <span class="fw-bold">{{ $disposisi->surat->asal_surat }}</span>
                        <div>{{ $disposisi->surat->perihal }}</div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
</div>
