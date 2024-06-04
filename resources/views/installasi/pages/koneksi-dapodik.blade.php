<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row mb-4 mt-2" style="margin-top:60px;">
        <div class="col-md-12 d-flex justify-content-between">
            <a class="btn btn-primary" href="{{ route('installasi.mode-user') }}" role="button">
                <svg class="icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
                </svg>
                Kembali
            </a>
            <a class="btn btn-primary" href="{{ route('installasi.mode-finish') }}" role="button">Lanjut / Lewati
                <svg class="icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-right') }}"></use>
                </svg>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 pt-4">
            <form method="POST" wire:submit="simpanDapodik">
                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat IP Aplikasi</label>
                    <input type="text" wire:model="ipAplikasi" class="form-control" aria-describedby="helpId" placeholder="Alamat IP Aplikasi">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat IP Dapodik</label>
                    <input type="text" wire:model="ipDapodik" class="form-control" aria-describedby="helpId" placeholder="Alamat IP Dapodik">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Key/Kunci Dapodik</label>
                    <input type="text" wire:model="kunciDapodik" class="form-control" aria-describedby="helpId" placeholder="Key/Kunci Dapodik">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">NPSN Sekolah</label>
                    <input type="text" wire:model="npsn" class="form-control" aria-describedby="helpId" placeholder="NPSN Sekolah">
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" type="submit" role="button">Simpan</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            @if ($statusKoneksi == true)
            <div class="data-part border rounded p-2 mb-3">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="judul-part fw-bold">Data Sekolah</h6>
                    <div>
                        <a class="btn btn-primary btn-sm {{ !$statusKoneksi ? 'disabled' : '' }}" wire:click="cekDtSekolah" role="button">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-sync') }}"></use>
                            </svg>
                            Cek
                        </a>
                        <a class="btn btn-primary btn-sm {{ $dtSekolah != null ? "" : "disabled" }}" wire:click="syncDtSekolah" role="button">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-download') }}"></use>
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{ $progDtSekolah }}%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="data-part border rounded p-2 mb-3">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="judul-part fw-bold">Data Gtk</h6>
                    <div>
                        <a class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:target="cekDtGtk" wire:click="cekDtGtk" role="button">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-sync') }}"></use>
                            </svg>
                            Cek
                        </a>
                        <a class="btn btn-primary btn-sm {{ $dtGtk != null ? "" : "disabled" }}" wire:click="syncDtGtk" role="button">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-download') }}"></use>
                            </svg>
                            Download ({{ $dtGtk != null ? $dtGtk->results : "0" }})
                        </a>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{ $dtGtk != null ? ($progDtGtk/$dtGtk->results)*100 : "0" }}%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="data-part border rounded p-2 mb-3">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="judul-part fw-bold">Data Siswa</h6>
                    <div>
                        <a class="btn btn-primary btn-sm {{ !$statusKoneksi ? 'disabled' : '' }}" wire:click="cekDtSiswa" role="button">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-sync') }}"></use>
                            </svg>
                            Cek
                        </a>
                        <a class="btn btn-primary btn-sm {{ $dtSiswa != null ? "" : "disabled" }}" wire:click="syncDtSiswa" role="button">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-download') }}"></use>
                            </svg>
                            Download ({{ $dtSiswa != null ? $dtSiswa->results : "0" }})
                        </a>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{ $dtSiswa != null ? ($progDtSiswa/$dtSiswa->results)*100 : "0" }}%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            @endif
        </div>
    </div>

</div>

