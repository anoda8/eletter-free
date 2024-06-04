<div class="row mt-1 mb-3">
    <form method="POST" wire:submit="simpanDanKirim">
        <div class="col">
            <label class="form-label mt-3 fw-bold">Pilih Kelas</label>
            <div class="overflow-auto mb-3 border" style="height: 200px;">
                <div class="list-group mb-3">
                    @foreach ($kelases as $kelas)
                        <div wire:key="{{ $kelas->id }}">
                            <input type="checkbox" wire:model="kelasTerpilih" value="{{ $kelas->nama_rombel }}" id="Kelas{{ $kelas->id }}" />
                            <label class="list-group-item" for="Kelas{{ $kelas->id }}">{{ $kelas->nama_rombel }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('kelasTerpilih')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label class="form-label fw-bold">Isi Pesan</label>
                <textarea class="form-control" wire:model="isiPesan" rows="7"></textarea>
                @error('isiPesan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="form-label fw-bold">Lampirkan Surat Keluar</label>
                <input type="text" wire:model.live="cariSuratKeluar" class="form-control" aria-describedby="helpId" placeholder="Cari Surat Keluar">
            </div>
            <div class="mb-3">
                @if (count($listSuratKeluar) > 0)
                    @foreach ($listSuratKeluar as $surKel)
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action cur-pointer" wire:click="pilihSuratKeluar('{{ $surKel->id }}')">{{ $surKel->perihal }}</li>
                    </ul>
                    @endforeach
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Lampirkan File
                    @if ($suratKeluar != null)
                        <span class="badge bg-danger cur-pointer" wire:click="resetSuratKeluar">
                            <svg style="width:17px;height:17px;">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-delete') }}"></use>
                            </svg>
                        </span>
                    @endif
                </label>
                @if ($suratKeluar != null)
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action list-group-item-primary cur-pointer" onclick="window.open('{{ asset('storage/arsip/'.$tanggal->year.'/surat-keluar/'.$tanggal->locale('id')->translatedFormat('F').'/'.$suratKeluar->id.'.pdf') }}', 'popUpWindow', 'height = 600, width = 500, left = 100, top = 100, scrollbars = yes, resizable = yes, menubar = no, toolbar = yes, location = no, directories = no, status = yes')">
                            {{ $suratKeluar->perihal }}
                        </li>
                    </ul>
                    @if ($suratKeluar->status < 2)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Peringatan</strong> Belum ada arsip surat keluar ini, silahkan upload arsip terlebih dahulu
                        </div>
                    @endif
                @else
                    <input class="form-control" wire:model="berkas" type="file" id="formFile">
                @endif
                @error('berkas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Kirim Ke Nomor HP Siswa/Orang Tua/Wali</label>
                <div class="row">
                    <div class="col">
                        <div class="list-group mb-3">
                            <div>
                                <input type="checkbox" wire:model="kirimKe" value="siswa" id="SemuaKelasSiswa" />
                                <label class="list-group-item" for="SemuaKelasSiswa">Siswa</label>
                            </div>
                        </div>
                        @error('kirimKe')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="list-group mb-3">
                            <div>
                                <input type="checkbox" wire:model="kirimKe" value="ortu" id="SemuaKelasGuru" />
                                <label class="list-group-item" for="SemuaKelasGuru">Orang Tua/Wali</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success" role="button">
                    Kirim
                    <svg style="width:17px;height:17px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-send') }}"></use>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
