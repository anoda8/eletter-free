<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="card">
        <div class="card-header">
            <h5 class="fw-bold">Arsip Surat Keluar</h5>
        </div>
        <div class="card-body">
            @if ($loggedInUser->isAbleTo('unggah-surat-keluar'))
                <a class="btn btn-success btn-sm mb-4" href="{{ route('arsip.keluar-upload') }}" role="button">
                    <svg class="nav-icon" style="width:15px;height:15px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                    </svg>
                    Tambah
                </a>
            @endif
            @if ($loggedInUser->isAbleTo('atur-nomor-surat-keluar'))
                <h6 class="fw-bold">Permintaan Surat Keluar</h6>
                <hr>
                <div class="table-responsive">
                    <table class="table table-secondary table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">N. Agenda</th>
                                <th class="text-center">N. Klasifikasi</th>
                                <th class="text-center">Perihal</th>
                                <th class="text-center">Tgl. Surat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reqSuratKeluar as $suratKeluar)
                            <tr>
                                <td scope="row" class="text-center">{{ $suratKeluar->nomor_agenda }}</td>
                                <td class="text-center">{{ $suratKeluar->klasifikasi->kode }}</td>
                                <td>{{ $suratKeluar->perihal }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($suratKeluar->tanggal_surat)->format("d/m/Y") }}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-sm" wire:click="prosesSurkel('{{ $suratKeluar->id }}')" data-bs-toggle="modal" data-bs-target="#modalProsesSuratKeluar" role="button" title="Proses">
                                        <svg class="nav-icon" style="width:15px;height:15px;">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-pin') }}"></use>
                                        </svg>
                                    </a>&nbsp;&nbsp;
                                    <a class="btn btn-info btn-sm" role="button" title="Edit" wire:click="pilihRequestSurkel('{{ $suratKeluar->id }}')" data-bs-toggle="modal" data-bs-target="#modalEditSurkel">
                                        <svg class="nav-icon" style="width:15px;height:15px;">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-pen-alt') }}"></use>
                                        </svg>
                                    </a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" wire:click="konfHapusSurkel('{{ $suratKeluar->id }}')" data-bs-toggle="modal" data-bs-target="#konfirmasiHapusSurkel" role="button" title="Hapus">
                                        <svg class="nav-icon" style="width:15px;height:15px;">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-trash') }}"></use>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <h6 class="fw-bold">Surat Keluar</h6>
            <hr>
            <livewire:arsip.tables.tabel-arsip-keluar lazy />
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modalProsesSuratKeluar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalProsesSuratKeluar" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalProsesSuratKeluar">Proses Surat Keluar</h5>
                        <button type="button" class="btn-close" wire:click="clearProsesSurkel" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fw-bold">{{ $surkelProses != null ? $surkelProses->perihal : "...loading" }}</h5>
                    <hr>
                    @if ($surkelProses != null)
                        @if ($surkelProses->nomor_agenda != '-')
                        <div class="text-center fw-bold">Nomor Surat</div>
                        <div class="text-center border rounded mb-3">
                            <h3 class="text-primary">{{ $surkelProses->klasifikasi->kode }} / {{ $surkelProses->nomor_agenda }}</h3>
                        </div>
                        @endif
                    @endif
                    <div class="text-center">
                        <button type="button" wire:click="setNomorSurkel" class="btn btn-sm btn-warning" {{ $surkelProses?->nomor_agenda != '-' ? "disabled" : ""}}>Dapatkan Nomor Surat</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" wire:click="clearProsesSurkel" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalEditSurkel" tabindex="-1" data-bs-keyboard="true" role="dialog" aria-labelledby="modalEditSuratKeluar" aria-hidden="true">
        <form method="POST" wire:submit="simpanEditedSuratKeluar">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditSuratKeluar">Edit Surat Keluar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor Klasifikasi</label>
                            <input type="text" wire:model.live="klasifikasi" list="listKlasifikasi" class="form-control" aria-describedby="helpId" placeholder="">
                        </div>
                        <datalist id="listKlasifikasi">
                            @foreach ($listKlasifikasi as $klasifikasi)
                                <option value="{{ $klasifikasi->kode }} - {{ $klasifikasi->klasifikasi }}">
                            @endforeach
                        </datalist>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Perihal</label>
                            <input type="text" wire:model="perihal" class="form-control" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Surat</label>
                            <input type="date" wire:model="tanggalSurat" class="form-control" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalEditSurkel'), options)

    </script>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="konfirmasiHapusSurkel" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="konfirmasiHapusSurkel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="konfirmasiHapusSurkel">Konfirmasi Hapus Permintaan Surat Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus {{ $surkelHapus != null ? $surkelHapus->perihal : "" }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-danger" wire:click="hapusSurkel">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
