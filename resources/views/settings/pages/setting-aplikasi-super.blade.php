<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="row">
        <div class="col-md-6">
            <form method="POST" wire:submit="simpanFonnte">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-bold">Pengaturan Fonnte</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Kirim Fonnte</label>
                            <input type="text" wire:model="fonnteAlamatKirim" class="form-control" aria-describedby="helpId" placeholder="Alamat API Fonnte">
                            @error('fonnteAlamatKirim')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kode Negara</label>
                            <input type="text" wire:model="fonnteKodeNegara" class="form-control" aria-describedby="helpId" placeholder="62 (Indonesia)">
                            @error('fonnteKodeNegara')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Authorization (Otorisasi Pesan Umum)</label>
                            <input type="text" wire:model="fonnteOtorisasiUmum" class="form-control" aria-describedby="helpId" placeholder="Otorisasi">
                            @error('fonnteOtorisasiUmum')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Batas Pesan Bulanan</label>
                            <input type="text" wire:model="fonnteBatasPesanBulanan" class="form-control" aria-describedby="helpId" placeholder="0">
                            @error('fonnteBatasPesanBulanan')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit" role="button">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form method="post" wire:submit="simpanAplikasi">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-bold">Pengaturan Aplikasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model="sekilasInfo" id="sekilasInfoSwitch">
                            <label class="form-check-label" for="sekilasInfoSwitch">Tampilkan Sekilas Info Dashboard</label>
                            @error('sekilasInfo')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit" role="button">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
