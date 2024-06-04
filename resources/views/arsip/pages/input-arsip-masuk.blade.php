<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card mb-4">
        <form method="POST" wire:submit="simpanArsipMasuk">
            <div class="card-header">
                <h5 class="fw-bold">Input Surat Masuk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label fw-bold">Nomor Agenda</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" wire:model="nomorAgenda" readonly>
                            <div class="input-group-append">
                                <a class="btn btn-primary" target="_blank" role="button" onclick="window.open('/storage/uploads/{{ $fileMasuk->id }}.pdf', 'popUpWindow', 'height = 600, width = 500, left = 100, top = 100, scrollbars = yes, resizable = yes, menubar = no, toolbar = yes, location = no, directories = no, status = yes')">
                                    <svg class="nav-icon" style="width:15px;height:15px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <label class="form-label fw-bold">Asal Surat</label>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" list="listInstansi" wire:model.live="asalSurat">
                                <datalist id="listInstansi">
                                    @foreach ($listInstansi as $instansi)
                                        <option value="{{ $instansi->nama_instansi }}">
                                    @endforeach
                                </datalist>
                                <div class="input-group-append">
                                    <a class="btn btn-success" role="button" wire:click="simpanInstansi">
                                        <svg class="nav-icon" style="width:15px;height:15px;">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @error('asalSurat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Perihal</label>
                            <input type="text" class="form-control" wire:model="perihal" aria-describedby="helpId" placeholder="">
                            @error('perihal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor Surat</label>
                            <input type="text" class="form-control" wire:model="nomorSurat" aria-describedby="helpId" placeholder="">
                            @error('nomorSurat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Surat</label>
                            <input type="date" class="form-control" wire:model="tanggalSurat" aria-describedby="helpId" placeholder="">
                            @error('tanggalSurat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor Klasifikasi</label>
                            <input type="text" class="form-control" list="listKlasifikasi" wire:model.live="nomorKlasifikasi" aria-describedby="helpId" placeholder="">
                            <datalist id="listKlasifikasi">
                                @foreach ($listKlasifikasi as $klasifikasi)
                                    <option value="{{ $klasifikasi->kode }} - {{ $klasifikasi->klasifikasi }}">
                                @endforeach
                            </datalist>
                            @error('nomorKlasifikasi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Diterima</label>
                            <input type="date" class="form-control" wire:model="tanggalDiterima" aria-describedby="helpId" placeholder="">
                            @error('tanggalDiterima')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Target Selesai</label>
                            <input type="date" class="form-control" wire:model="targetSelesai" aria-describedby="helpId" placeholder="">
                            @error('targetSelesai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch mt-4 mb-3">
                            <input class="form-check-input" type="checkbox" wire:model="kirimWaKepsek" role="switch" id="kirimDisposisi" {{ $arsipMasuk != null ? "disabled" : "" }}>
                            <label class="form-check-label cur-pointer" for="kirimDisposisi">Kirim Disposisi Ke Kepala Sekolah</label>
                            @error('kirimWaKepsek')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($waTerkirim == true)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Sukses</strong> Disposisi Kepala Sekolah terkirim.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type='submit' class="btn btn-success" role="button">
                    <svg class="nav-icon" style="width:15px;height:15px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                    </svg>
                    Simpan
                </button>
                @if ($arsipMasuk != null)
                &nbsp;&nbsp;
                <a class="btn btn-info" href="/arsip/arsip-masuk" role="button">
                    Data Arsip
                    <svg class="nav-icon" style="width:15px;height:15px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-right') }}"></use>
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>
</div>
