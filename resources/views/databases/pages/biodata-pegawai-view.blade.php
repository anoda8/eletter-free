<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="card">
        <form method="POST" wire:submit="simpanBiodataPegawai">
            <div class="card-header d-flex justify-content-between">
                <h5 class="fw-bold">{{ $pegawai->nama }}</h5>
                <div>
                    <a class="btn btn-secondary btn-sm" href="{{ route('settings.biodata-pegawai') }}" role="button">
                        <svg style="width:17px;height:17px;">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-left') }}"></use>
                        </svg>
                    </a>&nbsp;
                    <button type="submit" class="btn btn-primary btn-sm" role="button">Simpan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" aria-describedby="helpId" placeholder="" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <input type="text" class="form-control" wire:model="tanggalLahir" aria-describedby="helpId" placeholder="" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIP</label>
                            <input type="text" class="form-control" wire:model="nip" aria-describedby="helpId" placeholder="" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIK</label>
                            <input type="text" class="form-control" wire:model="nik" aria-describedby="helpId" placeholder="" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NUPTK</label>
                            <input type="text" class="form-control" wire:model="nuptk" aria-describedby="helpId" placeholder="" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" wire:model="pendidikanTerakhir" aria-describedby="helpId" placeholder="" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Golongan Terakhir</label>
                            <select class="form-select" wire:model="golonganTerakhir">
                                @foreach ($listPangkatGolongan as $key => $pangGol)
                                    <option value="{{ $key }}">{{ $pangGol }} - {{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Gelar Depan</label>
                            <input type="text" class="form-control" wire:model="gelarDepan" aria-describedby="helpId" placeholder="">
                        </div>
                        @error('gelarDepan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label fw-bold">Gelar Belakang</label>
                            <input type="text" class="form-control" wire:model="gelarBelakang" aria-describedby="helpId" placeholder="">
                        </div>
                        @error('gelarBelakang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor HP</label>
                            <input type="text" class="form-control" wire:model="nomorHp" aria-describedby="helpId" placeholder="">
                        </div>
                        @error('nomorHp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="tambahJabatan" class="form-label fw-bold">Tambah Jabatan</label>
                            <select class="form-select" wire:model.change="jabatanDitambahkan" id="tambahJabatan">
                                <option value="">- Pilih Jabatan -</option>
                                @foreach ($jabatan as $jbt)
                                    <option value="{{ $jbt->id }}">{{ $jbt->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jabatan</label>
                            <ul class="list-group">
                                @foreach ($jabatanPegawai as $key => $jbtpg)
                                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                                        <div>{{ $key + 1 }}. {{ $jbtpg->jabatan?->nama_jabatan }}</div>
                                        <span class="badge bg-danger rounded-pill cur-pointer" wire:click="hapusJabatan('{{ $jbtpg->id }}')">X</span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
