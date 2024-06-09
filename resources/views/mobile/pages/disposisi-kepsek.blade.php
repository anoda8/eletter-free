<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row mb-3">
        <div class="col-md-12">
            <form method="POST" wire:submit="simpanKirimDisposisi" id="simpanKirimDisposisi">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="fw-bold">Disposisi Surat Masuk</h5>
                        @if ($suratMasuk->status !== 0)
                            @if (\Auth::check())
                                @if (auth()->user()->biodataPegawai?->jenis_ptk_id_str != "Kepala Sekolah")
                                <a class="btn btn-secondary btn-sm" href="{{ route('mobile.disposisi-pegawai-daftar') }}" role="button" wire:navigate>
                                    <svg style="width:17px;height:17px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-left') }}"></use>
                                    </svg>
                                </a>
                                @else
                                <a class="btn btn-secondary btn-sm" href="{{ route('mobile.disposisi-kepsek-daftar') }}" role="button" wire:navigate>
                                    <svg style="width:17px;height:17px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-left') }}"></use>
                                    </svg>
                                </a>
                                @endif
                            @endif
                        @endif
                    </div>
                    <div class="card-body">
                        @if (\Auth::check() || ($allowed == true))
                            @if ($suratMasuk->status > 0)
                                <livewire:mobile.components.disposisi-view lazy :suratMasukId="$suratMasuk->id" />
                                <hr>
                            @endif
                        @endif
                        <ul class="list-group">
                            <div class="disposisi-title fw-bold">
                                Asal Surat
                            </div>
                            <li class="list-group-item">
                                <div class="disposisi-content">
                                    {{ $suratMasuk->asal_surat }}
                                </div>
                            </li>
                            <div class="disposisi-title fw-bold">
                                Perihal
                            </div>
                            <li class="list-group-item">
                                <div class="disposisi-content">
                                    {{ $suratMasuk->perihal }}
                                </div>
                            </li>
                            <div class="disposisi-title fw-bold">
                                Nomor Surat
                            </div>
                            <li class="list-group-item">
                                <div class="disposisi-content">
                                    {{ $suratMasuk->nomor_surat }}
                                </div>
                            </li>
                            <div class="disposisi-title fw-bold">
                                Tanggal Surat
                            </div>
                            <li class="list-group-item mb-2">
                                <div class="disposisi-content">
                                    {{ \Carbon\Carbon::parse($suratMasuk->tanggal_surat)->locale('id')->translatedFormat("l, d F Y") }}
                                </div>
                            </li>
                            @if (\Auth::check())
                                @if ($suratMasuk->status > 0)
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-success btn-sm" role="button" href="/arsip/disposisi-arsip-masuk-cetak/{{ $suratMasuk->id }}" target="_blank">
                                            <svg style="width:17px;height:17px;">
                                                <use xlink:href="{{ asset('icons/coreui.svg#cil-print') }}"></use>
                                            </svg>
                                            Cetak Lembar Disposisi
                                        </a>
                                    </div>
                                @endif
                            @endif
                            @if (\Auth::check() || ($allowed == true))
                                <iframe src="{{ config('app.url')."/pdfviewer/".$suratMasuk->tahun."_".$bulanFile."_".$suratMasuk->id }}" class="box-tampil-surat" width="100%" frameborder="0">Your browser doesnot support iframes</iframe>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-info btn-sm" role="button" href="/storage/arsip/{{ \Carbon\Carbon::parse($suratMasuk->created_at)->year }}/surat-masuk/{{ \Carbon\Carbon::parse($suratMasuk->created_at)->locale('id')->translatedFormat("F") }}/{{ $suratMasuk->id }}.pdf">
                                        <svg style="width:17px;height:17px;">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-download') }}"></use>
                                        </svg>
                                        Unduh File
                                    </a>
                                </div>
                            @endif
                            <div class="disposisi-title fw-bold">
                                Tanggal Diterima
                            </div>
                            <li class="list-group-item mb-3">
                                <div class="disposisi-content">
                                    {{ \Carbon\Carbon::parse($suratMasuk->tanggal_diterima)->locale('id')->translatedFormat("l, d F Y") }}
                                </div>
                            </li>
                            @if ($suratMasuk->status == 0 && ($allowed == true))
                                <div class="disposisi-title fw-bold">
                                    Sifat Surat
                                </div>
                                <li class="list-group-item {{ $sifatSurat != null ? "border-primary" : "list-group-item-secondary border-success" }} box-input cur-pointer" data-bs-toggle="modal" data-bs-target="#modalSifatSurat">
                                    <div class="disposisi-content">
                                        {{ $sifatSurat != null ? strtoupper($sifatSurat) : "BELUM DITENTUKAN" }}
                                    </div>
                                </li>
                                @error('sifatSurat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="disposisi-title fw-bold">
                                    Disposisi Ke
                                </div>
                                <li class="list-group-item {{ count($disposisiKe) > 0 ? "border-primary" : "list-group-item-secondary border-success" }} box-input cur-pointer" data-bs-toggle="modal" data-bs-target="#modalDisposisiKe">
                                    <div class="disposisi-content">
                                        @if (count($disposisiKe) > 0)
                                            @foreach ($disposisiKe as $dspk)
                                                @php
                                                    $jbtPegawai =  \App\Models\JabatanPegawai::find($dspk);
                                                @endphp
                                                {{ $jbtPegawai == null ? "Loading..." : $jbtPegawai->pegawai->nama; }};&nbsp;
                                            @endforeach
                                        @endif

                                        @if (count($tambahanDisposisiKe) > 0)
                                            <p></p>
                                            <span class="fw-bold">Tambahan Disposisi : </span><br>
                                            @foreach ($tambahanDisposisiKe as $dspk)
                                                @php
                                                    $pegawai =  \App\Models\BiodataPegawai::find($dspk);
                                                @endphp
                                                {{ $pegawai == null ? "Loading..." : $pegawai->nama; }};&nbsp;
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                                @error('disposisiKe')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="disposisi-title fw-bold">
                                    Catatan
                                </div>
                                <li class="list-group-item {{ count($catatan) > 0 ? "border-primary" : "list-group-item-secondary border-success" }} box-input cur-pointer" data-bs-toggle="modal" data-bs-target="#modalCatatan">
                                    <div class="disposisi-content">
                                        @if (count($catatan) > 0)
                                            @foreach ($catatan as $ct)
                                                @php
                                                    $ctan =  \App\Models\SettingCatatanDisposisi::find($ct);
                                                @endphp
                                                {{ $ctan == null ? "Loading..." : $ctan->catatan; }};&nbsp;<br>
                                            @endforeach
                                        @endif
                                        @if ($tambahanCatatan != null)
                                            <p></p>
                                            <span class="fw-bold">Tambahan Catatan : </span><br>
                                            - {{ $tambahanCatatan }}
                                        @endif
                                    </div>
                                </li>
                                @error('catatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="disposisi-title fw-bold">
                                    Tanggal Target Selesai
                                </div>
                                <li class="list-group-item box-input {{ $targetSelesai != null ? "border-primary" : "list-group-item-secondary border-success" }} cur-pointer" data-bs-toggle="modal" data-bs-target="#modalTargetSelesai">
                                    <div class="disposisi-content">
                                        @if ($targetSelesai != null)
                                            {{ \Carbon\Carbon::parse($targetSelesai)->locale('id')->translatedFormat("l, d F Y") }}
                                        @endif
                                    </div>
                                </li>
                                <div class="disposisi-title fw-bold">
                                    Surat Tugas
                                </div>
                                <li class="list-group-item {{ count($suratTugas) > 0 ? "border-primary" : "list-group-item-secondary border-success" }} box-input cur-pointer" data-bs-toggle="modal" data-bs-target="#modalSuratTugas">
                                    <div class="disposisi-content">
                                        @if (count($suratTugas) > 0)
                                            @foreach ($suratTugas as $srgs)
                                                @php
                                                    $pegawai =  \App\Models\BiodataPegawai::find($srgs);
                                                @endphp
                                                {{ $pegawai == null ? "Loading..." : $pegawai->nama; }};&nbsp;
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                            @endif
                            @if (!\Auth::check() && !$allowed)
                                <div class="alert alert-warning" role="alert">
                                    <strong>Login untuk melihat Disposisi</strong>
                                </div>
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        @if ($suratMasuk->status == 0)
                            <form method="POST" wire:submit="simpanKirimDisposisi">
                                <button class="btn btn-success" type="submit" role="button">
                                    <svg style="width:17px;height:17px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                                    </svg>
                                    Simpan & Kirim
                                </button>
                            </form>
                        @endif

                        @if (!\Auth::check() && !$allowed)
                           <a class="btn btn-primary" href="/disposisi-pegawai-detail/{{ $suratMasuk->id }}" role="button">Log In</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalSifatSurat" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalSifatSurat" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSifatSurat">Sifat Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <a class="btn btn-lg btn-{{ $sifatSurat == 'rahasia' ? '' : "outline-" }}danger" wire:click="ubahSifatSurat('rahasia')" role="button">RAHASIA</a>
                    <a class="btn btn-lg btn-{{ $sifatSurat == 'penting' ? '' : "outline-" }}warning" wire:click="ubahSifatSurat('penting')" role="button">PENTING</a>
                    <a class="btn btn-lg btn-{{ $sifatSurat == 'rutin' ? '' : "outline-" }}info" wire:click="ubahSifatSurat('rutin')" role="button">RUTIN</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalDisposisiKe" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalDisposisiKe" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDisposisiKe">Disposisi Ke</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group mb-3">
                        @foreach ($listJabatan as $key =>  $jabatan)
                            <div wire:key="{{ $jabatan->id }}">
                                <input type="checkbox" wire:model.live="disposisiKe" value="{{ $jabatan->jabatanPegawai->id }}" id="{{ $jabatan->jabatanPegawai->id }}" />
                                <label class="list-group-item" for="{{ $jabatan->jabatanPegawai->id }}">{{ $jabatan->nama_jabatan }} [{{ $jabatan->jabatanPegawai->pegawai->nama }}]</label>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <label class="form-label fw-bold">Tambahan disposisi untuk :</label>
                        <input type="text" wire:model.live="cariTambahanDisposisiKe" class="form-control" aria-describedby="helpId" placeholder="Ketik untuk mencari">
                    </div>
                    <div class="mb-3">
                        @if (count($foundTambahanDisposisiKe) > 0)
                        <ul class="list-group">
                            @foreach ($foundTambahanDisposisiKe as $pegawai)
                                <li class="list-group-item list-group-item-action cur-pointer" wire:click="addTambahanDisposisi('{{ $pegawai->id }}')">
                                    {{ $pegawai->nama }}
                                </li>
                            @endforeach
                        </ul>
                        @endif
                        @if (count($tambahanDisposisiKe) > 0)
                            <ul class="list-group mt-3">
                                @foreach ($tambahanDisposisiKe as $tambahanDisposisi)
                                    <li class="list-group-item list-group-item-secondary d-flex justify-content-between">
                                        {{ \App\Models\BiodataPegawai::find($tambahanDisposisi)->nama }}
                                        <span class="badge bg-danger cur-pointer" wire:click="removeTambahanDisposisi('{{ $tambahanDisposisi }}')">X</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalCatatan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalCatatan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCatatan">Catatan Disposisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group mb-2">
                        @foreach ($listCatatan as $key =>  $ct)
                            <div wire:key="{{ $jabatan->id }}">
                                <input type="checkbox" wire:model.live="catatan" value="{{ $ct->id }}" id="catatan-{{ $ct->id }}" />
                                <label class="list-group-item" for="catatan-{{ $ct->id }}">{{ $ct->catatan }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tambahan Catatan</label>
                        <textarea class="form-control" wire:model.live="tambahanCatatan" rows="3"></textarea>
                        <div class="d-flex justify-content-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="">
                                <label class="form-check-label" for="">
                                    Tambahkan ke dalam daftar catatan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalSuratTugas" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalSuratTugas" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSuratTugas">Berikan Surat Tugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cari Nama Pegawai</label>
                        <input type="text" wire:model.live="cariSuratTugas" class="form-control" aria-describedby="helpId" placeholder="">
                    </div>
                    @if (count($foundSuratTugas) > 0)
                        <ul class="list-group">
                            @foreach ($foundSuratTugas as $pegawai)
                                <li class="list-group-item list-group-item-action cur-pointer" wire:click="addTambahanSurgas('{{ $pegawai->id }}')">{{ $pegawai->nama }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if (count($suratTugas) > 0)
                        <ul class="list-group mt-3">
                            @foreach ($suratTugas as $surgas)
                                <li class="list-group-item list-group-item-secondary d-flex justify-content-between">
                                    {{ \App\Models\BiodataPegawai::find($surgas)->nama }}
                                    <span class="badge bg-danger cur-pointer" wire:click="removeTambahanSurgas('{{ $surgas }}')">X</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalTargetSelesai" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTargetSelesai" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTargetSelesai">Tanggal Target Selesai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tentukan Tanggal</label>
                        <input type="date" wire:model.live="targetSelesai" class="form-control" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <style>
        .box-tampil-surat{
            min-height: 750px;
        }
        .box-input{
            min-height: 40px;
        }
    </style>
@endpush
