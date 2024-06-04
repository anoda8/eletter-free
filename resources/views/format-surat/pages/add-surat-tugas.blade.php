<div>
    {{-- Stop trying to control. --}}
    <form method="POST" wire:submit="simpanSuratTugas">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <h5 class="fw-bold">{{ $mode == 'tambah' ? "Tambah " : "Edit " }} Surat Tugas</h5>
                <div>
                    @if ($mode == 'edit')
                        <a class="btn btn-secondary btn-sm" href="/format-surat/surat-tugas" role="button" wire:navigate>
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-left') }}"></use>
                            </svg>
                        </a>
                    @endif
                    <button type='submit' class="btn btn-sm btn-success" role="button">
                        <svg class="nav-icon" style="width:15px;height:15px;">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                        </svg>
                        Simpan
                    </button>
                    @if ($mode == 'edit')
                        <a class="btn btn-sm btn-info" href="/format-surat/cetak-surat-tugas/{{ $suratTugasId }}" target="_blank">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-print') }}"></use>
                            </svg>
                            Cetak
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold required">Dasar Surat Tugas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" list="dataListPerihal" wire:model.live="dasarAsal" aria-describedby="helpId" placeholder="">
                                @if ($arsipMasukTerpilih)
                                <a class="btn btn-primary btn-sm" role="button"  onclick="window.open('{{ config('app.url').'/storage/arsip/'.$arsipMasukTerpilih->tahun.'/surat-masuk/'.\Carbon\Carbon::parse($arsipMasukTerpilih->tanggal_diterima)->locale('id')->translatedFormat('F').'/'.$arsipMasukTerpilih->id.'.pdf' }}', 'popUpWindow', 'height = 600, width = 500, left = 100, top = 100, scrollbars = yes, resizable = yes, menubar = no, toolbar = yes, location = no, directories = no, status = yes')">
                                    <svg class="nav-icon" style="width:15px;height:15px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                                    </svg>
                                </a>
                                @endif
                            </div>
                            @error('dasarAsal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <ul class="list-group mb-3">
                                @foreach ($dataListPerihal as $suratMasuk)
                                    <li class="list-group-item list-group-item-action cur-pointer" wire:click="pilihDasarSurat('{{ $suratMasuk['id'] }}')">{{ $suratMasuk['perihal'] }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Dasar Nomor</label>
                            <input type="text" class="form-control" wire:model="dasarNomor" aria-describedby="helpId" placeholder="">
                            @error('dasarNomor')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dasar Tanggal</label>
                            <input type="date" class="form-control" wire:model="dasarTanggal" aria-describedby="helpId" placeholder="">
                            @error('dasarTanggal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dasar Perihal</label>
                            <input type="text" class="form-control" wire:model="dasarPerihal" aria-describedby="helpId" placeholder="">
                            @error('dasarPerihal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tujuan</label>
                            <input type="text" class="form-control" wire:model="dasarTujuan" aria-describedby="helpId" placeholder="">
                            @error('dasarTujuan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tempat</label>
                            <input type="text" class="form-control" wire:model="tempat" aria-describedby="helpId" placeholder="">
                            @error('tempat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Tempat Kegiatan</label>
                            <input type="text" class="form-control" wire:model="alamat" aria-describedby="helpId" placeholder="">
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Kegiatan</label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold">Mulai</span>
                            <input type="date" class="form-control" wire:model="tanggalMulai" placeholder="Tanggal mulai">
                            <span class="input-group-text fw-bold">Selesai</span>
                            <input type="date" class="form-control" wire:model="tanggalSelesai" placeholder="Tanggal selesai">
                        </div>
                        <div class="mb-3">
                            @error('tanggalMulai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('tanggalSelesai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Waktu</label>
                            <input type="time" class="form-control" wire:model="waktu" aria-describedby="helpId" placeholder="tanggal surat">
                            @error('waktu')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Surat</label>
                            <input type="date" class="form-control" wire:model="tanggalSuratTugas" aria-describedby="helpId" placeholder="tanggal surat">
                            @error('tanggalSuratTugas')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pejabat Penandatangan</label>
                            <input type="text" class="form-control" wire:model="pejabat" aria-describedby="helpId" placeholder="tanggal surat">
                            @error('pejabat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Pejabat Penandatangan</label>
                            <input type="text" class="form-control" wire:model="namaPejabat" aria-describedby="helpId" placeholder="tanggal surat">
                            @error('namaPejabat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIP Pejabat Penandatangan</label>
                            <input type="text" class="form-control" wire:model="nipPejabat" aria-describedby="helpId" placeholder="tanggal surat">
                            @error('nipPejabat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="fw-bold">Ditugaskan untuk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cari Nama Pegawai</label>
                            <input type="text" class="form-control" wire:model.live="cariTugasPegawai" aria-describedby="helpId">
                            @if (count($listPegawaiTugas) > 0)
                                @foreach ($listPegawaiTugas as $pegawai)
                                    @if ($pegawai->jabatans->count() > 1)
                                        <ul class="list-group">
                                            <li class="list-group-item list-group-item-action cur-pointer" data-bs-toggle="modal" data-bs-target="#modalPilihJabatan" wire:click="showListJabatanPegawai('{{ $pegawai->id }}')">{{ $pegawai->nama }}</li>
                                        </ul>
                                    @else
                                        <ul class="list-group">
                                            <li class="list-group-item list-group-item-action cur-pointer" wire:click="addPegawai('{{ $pegawai?->jabatans->first()?->id }}')">{{ $pegawai?->nama }}</li>
                                        </ul>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        @foreach ($tugasPegawai as $key => $pgw)
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-primary d-flex justify-content-between">
                                    <div>{{ $key + 1 }} - {{ $pgw->pegawai->nama }}</div>
                                    <span class="badge rounded-pill bg-danger cur-pointer" wire:click="delPegawai('{{ $pgw->id }}')">X</span>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <div>
                    @if ($mode == 'edit')
                        <a class="btn btn-secondary btn-sm" href="/format-surat/surat-tugas" role="button" wire:navigate>
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-left') }}"></use>
                            </svg>
                        </a>
                    @endif
                    <button type='submit' class="btn btn-sm btn-success" role="button">
                        <svg class="nav-icon" style="width:15px;height:15px;">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                        </svg>
                        Simpan
                    </button>
                    @if ($mode == 'edit')
                        <a class="btn btn-sm btn-info" href="/format-surat/cetak-surat-tugas/{{ $suratTugasId }}" target="_blank">
                            <svg class="nav-icon" style="width:15px;height:15px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-print') }}"></use>
                            </svg>
                            Cetak
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalPilihJabatan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalPilihJabatan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPilihJabatan">Pilih Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (count($opsiJabatanPegawai) > 0)
                        @foreach ($opsiJabatanPegawai as $jbtPgw)
                            <div class="list-group">
                                <a class="list-group-item list-group-item-action cur-pointer" wire:click="addPegawai('{{ $jbtPgw->id }}')">{{ $jbtPgw->pegawai->nama }} [{{ $jbtPgw->jabatan->nama_jabatan }}]</a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
