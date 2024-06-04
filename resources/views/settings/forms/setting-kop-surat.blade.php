<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="card mb-3">
        <form method="POST" wire:submit="simpanKop">
            <div class="card-header">
                <h5 class="fw-bold">Pengaturan KOP Surat</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    @if ($logo != null)
                        <img src="{{ $logo->temporaryUrl() }}" style="width:100px;" class="img-fluid" alt="">
                    @else
                        <img src="/storage/images/logo-kop.png" style="width:100px;" class="img-fluid" alt="">
                    @endif
                </div>
                <label for="UploadFoto" class="fw-bold">Logo KOP </label>
                <div class="mb-3">
                    <input type="file" wire:model="logo" class="form-control" aria-label="Upload Foto">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Instansi baris 1</label>
                    <input type="text" wire:model="instansiBaris1" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Instansi baris 2</label>
                    <input type="text" wire:model="instansiBaris2" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Sekolah</label>
                    <input type="text" wire:model="namaSekolah" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat</label>
                    <input type="text" wire:model="alamat" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Telepon</label>
                    <input type="text" wire:model="telepon" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Fax</label>
                    <input type="text" wire:model="fax" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Kota / Kabupaten</label>
                    <input type="text" wire:model="kotaKabupaten" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Kode POS</label>
                    <input type="text" wire:model="kodePos" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">E-Mail</label>
                    <input type="text" wire:model="email" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Website</label>
                    <input type="text" wire:model="website" class="form-control" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-success" role="button" type="submit">
                    <svg style="width:17px;height:17px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
