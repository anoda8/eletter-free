<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="card">
        <div class="card-header {{ $statusKoneksi ? "bg-success" : "bg-danger" }}">
            <h5 class="text-white">Sinkronisasi Data Referensi Dapodik</h5>
        </div>
        <div class="card-body">
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
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="data-part border rounded p-2 mb-3">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="judul-part fw-bold">Data Gtk</h6>
                    <div>
                        <a class="btn btn-primary btn-sm {{ !$statusKoneksi ? 'disabled' : '' }}" wire:click="cekDtGtk" role="button">
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
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
