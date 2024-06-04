<div>
    <form method="POST" wire:submit="simpan">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Name/Code</label>
                    <input type="text" class="form-control" wire:model.live="name" aria-describedby="helpId" placeholder="" readonly />
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Display Name</label>
                    <input type="text" class="form-control" wire:model="displayName" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <input type="text" class="form-control" wire:model="description" aria-describedby="helpId" placeholder="">
                </div>
                <hr>
                <b>Permission</b>
                <div class="row">
                    @foreach ($listPermission->chunk(3) as $permissions)
                        <div class="col-md-4">
                            @foreach ($permissions as $prms)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="rolePermission" value="{{ $prms->name }}">
                                    <label class="form-check-label">
                                        {{ $prms->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <div>
                    <a class="btn btn-secondary" href="{{ route('izin-akses.roles') }}" role="button">Kembali</a>
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
