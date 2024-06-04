<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="fw-bold">Jabatan</h5>
            <div class="d-flex justify-content-end mb-2">
                <a class="btn btn-success btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#modalTambahJabatan">
                    <svg class="icon me-2">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                    </svg>
                    Tambah Jabatan
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:settings.tables.jabatan />
        </div>
    </div>


    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalTambahJabatan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTambahJabatan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" wire:submit="simpanJabatan">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahJabatan">Tambah Jabatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Jabatan</label>
                            <input type="text" class="form-control" wire:model="namaJabatan" aria-describedby="helpId" placeholder="Nama Jabatan">
                            @error('namaJabatan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold">Pegawai</label>
                            <input type="text" class="form-control" wire:model.live="pegawai" aria-describedby="helpId" placeholder="Pegawai">
                            @error('pegawai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            @if ($listPegawai !== null)
                                <ul class="list-group">
                                    @foreach ($listPegawai as $pegawai)
                                        <li class="list-group-item list-group-item-action cur-pointer" wire:click="pilihPegawai('{{ $pegawai->id }}')">{{ $pegawai->nama }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="form-check cur-pointer">
                            <input class="form-check-input" type="checkbox" wire:model="tampilDisposisi" id="tampilDisposisi">
                            <label class="form-check-label" for="tampilDisposisi">
                                Tampilkan di form Disposisi
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalGantiUrutan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalGantiUrutan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <form method="POST" wire:submit="simpanUrutan">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalGantiUrutan">Ganti Urutan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        @if ($jumlahJabatan > 0)
                            <select class="form-select form-select-lg" wire:model.change="urutan">
                                <option value="">- Pilih Urtan -</option>
                                @for ($i = 1; $i <= $jumlahJabatan; $i++)
                                    <option value="{{ $i }}" {{ $i == $urutanTerpilih ? "selected" : "" }}>{{ $i }}</option>
                                @endfor
                            </select>
                        @else
                            Memuat...
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
