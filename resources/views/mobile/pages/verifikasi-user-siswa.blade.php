<div class="row">
    <div class="col-md-3 col-sm-0"></div>
    <div class="col-md-6 col-sm-12">
        <form method="POST" wire:submit="cekBiodata">
            <div class="card">
                <div class="card-header">
                    <h5>Periksa Data Siswa</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">NISN</label>
                        <input type="text" wire:model="nisn" class="form-control" aria-describedby="helpId" placeholder="Nomor Induk Siswa Nasional (NISN)">
                        @error('nisn')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Lahir</label>
                        <input type="date" wire:model="tanggalLahir" class="form-control" aria-describedby="helpId" placeholder="Tanggal Lahir">
                        @error('tanggalLahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success" role="button">
                        Lanjut
                        <svg style="width:17px;height:17px;">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-right') }}"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3 col-sm-0"></div>
</div>
