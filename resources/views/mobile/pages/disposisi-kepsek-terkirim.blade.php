<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="card">
        <div class="card-header">
            <h5 class="text-center">Disposisi Surat Masuk</h5>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid" src="/storage/images/3d-checklist.jpg" alt="Gambar tidak ditemukan" style="max-width: 200px;">
            </div>
            @if ($data != null)
                <div class="text-center mb-3">
                    <h5>{{ $data['surat']['asal-surat'] }}</h5>
                    <h6>{{ $data['surat']['perihal'] }}</h6>
                </div>
                <ul class="list-group mb-3">
                    @foreach ($data['pesan-terkirim'] as $pegawaiTerkirim)
                        <li class="list-group-item list-group-item-success list-group-item-action mb-2 d-flex justify-content-between">
                            {{ $pegawaiTerkirim }} &nbsp;&nbsp;&nbsp;
                            <span class="badge bg-success">
                                <svg style="width:17px;height:17px;">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-check') }}"></use>
                                </svg>
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="mt-3 mb-3">
                <div class="alert alert-warning" role="alert">
                    Ada <strong>{{ $jmlSuratBaru }}</strong> surat baru
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-secondary" role="button" href="{{ route('mobile.disposisi-kepsek-daftar') }}">
                    <svg style="width:17px;height:17px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-storage') }}"></use>
                    </svg>
                    Daftar Surat Masuk
                </a>
            </div>
        </div>
    </div>
</div>
