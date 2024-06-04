<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row mb-5">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if ($tersimpan == true)
                <div class="card">
                    <div class="card-header">
                        <h5>Registrasi Sukses</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="/storage/images/3d-checklist.jpg" class="img-fluid" style="max-width: 200px;" alt="Gambar tidak dapat dimuat">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-secondary" href="/verifikasi-akun-siswa" role="button">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-reload') }}"></use>
                            </svg>
                            Ulangi Langkah Awal
                        </a>
                    </div>
                </div>
            @else
            <form method="POST" wire:submit="simpanBiodata">
                <div class="card">
                    <div class="card-header">
                        <h5>Registrasi Nomor Whatsapp</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Siswa</label>
                            <input type="text" value="{{ $biodataSiswa->nama }}" class="form-control" aria-describedby="helpId" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kelas</label>
                            <input type="text" value="{{ $biodataSiswa->nama_rombel }}" class="form-control" aria-describedby="helpId" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NISN</label>
                            <input type="text" value="{{ $biodataSiswa->nisn }}" class="form-control" aria-describedby="helpId" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor HP</label>
                            <input type="text" wire:model="nomorHp" class="form-control" aria-describedby="helpId" placeholder="08xxxxxxxxxx">
                            @error('nomorHp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor HP Orang Tua/Wali</label>
                            <input type="text" wire:model="nomorHpOrtu" class="form-control" aria-describedby="helpId" placeholder="08xxxxxxxxxx">
                            @error('nomorHpOrtu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success" type="submit" role="button">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                            </svg>
                            Simpan & Lanjut
                        </button>
                    </div>
                </div>
            </form>
            @endif

        </div>
        <div class="col-md-3"></div>
    </div>

</div>
