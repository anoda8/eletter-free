<div>
    {{-- Stop trying to control. --}}
    <form method="POST" wire:submit="simpanTampilan">
        <div class="card">
            <div class="card-header">
                <h5 class="fw-bold">Tampilan Panel Aplikasi</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    @if ($logoPanel != null)
                        <img src="{{ $logoPanel->temporaryUrl() }}" alt="noImage">
                    @else
                        <img src="/storage/images/eletterv2.png" alt="noImage">
                    @endif
                </div>
                <label for="LogoPanel" class="fw-bold">Logo Panel</label>
                <div class="mb-3">
                    <input type="file" wire:model="logoPanel" class="form-control" aria-label="LogoPanel">
                    @error('logoPanel')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Nama Aplikasi</label>
                  <input type="text" wire:model="namaAplikasi" class="form-control" aria-describedby="helpId" placeholder="Nama Aplikasi">
                    @error('namaAplikasi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Awal Arsip Masuk</label>
                    <input type="text" wire:model="nomorAwalArsipMasuk" class="form-control" aria-describedby="helpId" placeholder="Nomor Awal Arsip Masuk">
                    @error('nomorAwalArsipMasuk')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Awal Arsip Keluar</label>
                    <input type="text" wire:model="nomorAwalArsipKeluar" class="form-control" aria-describedby="helpId" placeholder="Nomor Awal Arsip Keluar">
                    @error('nomorAwalArsipKeluar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
</div>
