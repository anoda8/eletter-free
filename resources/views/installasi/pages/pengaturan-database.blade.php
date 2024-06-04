<div>
    {{-- Stop trying to control. --}}
    <form method="POST" wire:submit="submit">
        <div class="row mb-4 mt-2">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" role="button">Lanjut
                    <svg class="icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-right') }}"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="row">
            @if ($errorMessage != null)
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <strong>Terjadi Kesalahan</strong> {{ $errorMessage }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6 {{ $errorMessage != null ? "" : "pt-4"}}">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Aplikasi</label>
                    <input type="text" class="form-control" wire:model="namaAplikasi" aria-describedby="helpId" placeholder="E-Letter SMA Negeri Jawa Tengah">
                    @error('namaAplikasi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label fw-bold">URL Aplikasi</label>
                    <input type="text" class="form-control" wire:model="hostAplikasi" aria-describedby="helpId" placeholder="http://localhost">
                    @error('hostAplikasi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Database</label>
                    <input type="text" class="form-control" wire:model="namaDatabase" aria-describedby="helpId" placeholder="Nama Database">
                    @error('namaDatabase')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">User Database</label>
                    <input type="text" class="form-control" wire:model="userDatabase" aria-describedby="helpId" placeholder="User Database">
                    @error('userDatabase')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Password Database</label>
                    <input type="text" class="form-control" wire:model="passwordDatabase" aria-describedby="helpId" placeholder="Password Database">
                    @error('passwordDatabase')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

    </form>
</div>
