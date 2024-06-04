<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="card">
        <div class="card-header">
            <h5 class="fw-bold">Arsip Surat Masuk</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div>
                        @if (auth()->user()->isAbleTo('unggah-surat-masuk'))
                            <a class="btn btn-success btn-sm mb-4" href="{{ route('arsip.masuk-upload') }}" role="button">
                                <svg class="nav-icon" style="width:15px;height:15px;">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                                </svg>
                                Tambah
                            </a>
                        @endif
                    </div>
                    <div>
                    </div>
                </div>

            </div>
            @if ($jmlSuratBaru > 0)
                    <div class="alert alert-info text-dark mr-2 ml-2" role="alert">
                        <strong>{{ $jmlSuratBaru }}</strong> surat masuk belum didisposisi
                    </div>
            @endif
            @if (session('kesalahan'))
                <div class="mb-3 alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Peringatan</strong>&nbsp;&nbsp;{{ session('kesalahan') }}
                </div>
            @endif
            <livewire:arsip.tables.tabel-arsip-masuk lazy />
        </div>
    </div>
</div>
