<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="card">
        <form method="POST" wire:submit="simpan">
            <div class="card-header {{ $statusKoneksi ? "bg-success" : "bg-danger" }} d-flex justify-content-between">
                <h5 class="text-white">Koneksi Dapodik</h5>
                <a class="btn {{ $statusKoneksi ? "btn-outline-primary disabled" : "btn-warning" }} fw-bold" role="button" wire:click="cekKoneksiDapodik">
                    {{ $statusKoneksi ? "Terhubung ke Server Dapodik" : "Tidak Terhubung ke server dapodik" }}
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Koneksi</label>
                    <input class="form-control" type="text" name="name" placeholder="{{ __('Name') }}"
                        wire:model="namaKoneksi" required>
                    @error('namaKoneksi')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">IP Aplikasi</label>
                    <input class="form-control" type="text" name="name" placeholder="{{ __('Name') }}"
                        wire:model="ipAplikasi" required>
                    @error('ipAplikasi')
                    <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">IP Dapodik</label>
                    <input class="form-control" type="text" name="name" placeholder="{{ __('Name') }}"
                        wire:model="ipDapodik" required>
                    @error('ipDapodik')
                    <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Key / Kunci Dapodik</label>
                    <input class="form-control" type="text" name="name" placeholder="{{ __('Name') }}"
                        wire:model="key" required>
                    @error('key')
                    <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">NPSN Sekolah</label>
                    <input class="form-control" type="text" name="name" placeholder="{{ __('Name') }}"
                        wire:model="npsn" required>
                    @error('npsn')
                    <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" role="button">Simpan</button>
            </div>
        </form>
    </div>

</div>
