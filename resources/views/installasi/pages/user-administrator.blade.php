<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <form method="POST" wire:submit="simpan">
        <div class="row mb-4 mt-2" style="margin-top:60px;">
            <div class="col-md-12 d-flex justify-content-between">
                <a class="btn btn-primary" href="{{ route('installasi.pilih-mode') }}" role="button">
                    <svg class="icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
                    </svg>
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary" role="button">Lanjut
                    <svg class="icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-right') }}"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pt-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" wire:model="nama" class="form-control" aria-describedby="helpId" placeholder="Nama">
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" wire:model="username" class="form-control" aria-describedby="helpId" placeholder="Username">
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="text" wire:model="email" class="form-control" aria-describedby="helpId" placeholder="Email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" wire:model="password" class="form-control" aria-describedby="helpId" placeholder="Password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Ulangi Password</label>
                    <input type="password" wire:model="password_confirmation" class="form-control" aria-describedby="helpId" placeholder="Ulangi Password">
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>

    </form>
</div>
