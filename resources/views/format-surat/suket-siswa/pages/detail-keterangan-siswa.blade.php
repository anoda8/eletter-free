<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="card mb-4">
        <form method="POST" wire:submit="simpanSuket">
            <div class="card-header d-flex justify-content-between">
                <h5 class="fw-bold">Tambah/Detail Surat Keterangan Siswa</h5>
                <div>
                    <a class="btn btn-secondary btn-sm" href="{{ route('format.surat-keterangan-siswa') }}" role="button" wire:navigate>
                        <svg style="width:17px;height:17px;">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-left') }}"></use>
                        </svg>
                    </a>
                    <button type="submit" class="btn btn-success btn-sm" href="#" role="button">Simpan</button>
                    @if ($suratKeterangan != null)
                        <a class="btn btn-outline-primary btn-sm" target="_blank" href="/format-surat/cetak-keterangan-siswa/{{ $suratKeterangan->id }}" role="button">Cetak</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Yang Menerangkan</label>
                            <textarea class="form-control" wire:model="ygMenerangkan" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Siswa</label>
                            <div class="input-group">
                                <input type="text" wire:model.live="nama" class="form-control" aria-describedby="helpId" placeholder="">
                                @if ($siswaTerpilih != null)
                                <a class="btn btn-danger btn-sm" role="button" wire:click="resetSiswaTerpilih">
                                    <svg class="nav-icon" style="width:15px;height:15px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-sync') }}"></use>
                                    </svg>
                                </a>
                                @endif
                            </div>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @if ($nama != null)
                            <ul class="list-group mb-3">
                                @foreach ($listNamaSiswa as $siswa)
                                    <li class="list-group-item list-group-item-action cur-pointer" wire:click="pilihSiswa('{{ $siswa->id }}')">{{ $siswa->nama }} [{{ $siswa->nipd }}][{{ $siswa->nama_rombel }}]</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tempat Lahir</label>
                            <input type="text" wire:model="tempatLahir" class="form-control" aria-describedby="helpId" placeholder="">
                            @error('tempatLahir')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <input type="date" wire:model="tanggalLahir" class="form-control" aria-describedby="helpId" placeholder="">
                            @error('tanggalLahir')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kelas</label>
                            <input type="text" wire:model="rombel" class="form-control" aria-describedby="helpId" placeholder="">
                            @error('rombel')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIS</label>
                            <input type="text" wire:model="nipd" class="form-control" aria-describedby="helpId" placeholder="">
                            @error('nipd')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NISN</label>
                            <input type="text" wire:model="nisn" class="form-control" aria-describedby="helpId" placeholder="">
                            @error('nisn')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Menerangkan</label>
                            <textarea class="form-control" wire:model="menerangkan" rows="3"></textarea>
                            @error('menerangkan')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Keperluan</label>
                            <textarea class="form-control" wire:model="keperluan" rows="3"></textarea>
                            @error('keperluan')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kota Surat</label>
                            <input type="text" class="form-control" wire:model="kota" aria-describedby="helpId" placeholder="tanggal surat">
                            @error('kota')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Surat</label>
                            <input type="date" class="form-control" wire:model="tanggalSuket" aria-describedby="helpId" placeholder="tanggal surat">
                            @error('tanggalSuket')
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
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-sm" href="#" role="button">Simpan</button>
            </div>
        </form>
    </div>
</div>
