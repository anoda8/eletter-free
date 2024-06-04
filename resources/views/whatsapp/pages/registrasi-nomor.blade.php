<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Riwayat Registrasi Nomor Whatsapp</h5>
            <a class="btn btn-success btn-sm" role="button" href="{{ route('mobile.verifikasi-user-siswa') }}" target="_blank">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-external-link') }}"></use>
                </svg>
                Link Registrasi
            </a>
        </div>
        <div class="card-body">
            <livewire:whatsapp.table.tabel-registrasi-whatsapp lazy />
        </div>
    </div>
</div>
