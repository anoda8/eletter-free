<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="card mb-5">
        <form method="POST" wire:submit="simpanSuratKeluar">
            <div class="card-header d-flex justify-content-start">
                <h5 class="fw-bold">Unggah Arsip Keluar</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold required">Perihal</label>
                            <textarea class="form-control" rows="2" wire:model="perihal" placeholder="Perihal"></textarea>
                            @error('perihal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold required">Kode Klasifikasi</label>
                            <input type="text" class="form-control" list="listKlasifikasi" wire:model.live="kodeKlasifikasi" aria-describedby="helpId" placeholder="Kode Klasifikasi">
                            @if ($klasifikasi)
                                <span class="text-primary mt-2 ms-2">{{ $klasifikasi }}</span>
                            @endif
                            <datalist id="listKlasifikasi">
                                @foreach ($listKlasifikasi as $klasifikasi)
                                    <option value="{{ $klasifikasi->kode }} - {{ $klasifikasi->klasifikasi }}">
                                @endforeach
                            </datalist>
                            @error('kodeKlasifikasi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold required">Tanggal Surat</label>
                            <input type="date" class="form-control" wire:model="tanggalSurat" aria-describedby="helpId" placeholder="">
                            @error('tanggalSurat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kepada Yth</label>
                            <input type="text" class="form-control" placeholder="Kepada Yth" wire:model="kepadaYth">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="form-check form-switch mt-2 mb-3">
                                <div>
                                    <input class="form-check-input cur-pointer" type="checkbox" id="switchNotifKepsek" wire:model.change="notifKepsek">
                                    <label class="form-check-label cur-pointer" for="switchNotifKepsek">Kirim pemberitahuan ke kepala sekolah</label>
                                </div>
                            </div>
                            <div class="form-check form-switch mt-2 mb-3">
                                <div>
                                    <input class="form-check-input cur-pointer" type="checkbox" id="switchUnggahBerkas" wire:model.change="apaUnggahBerkas">
                                    <label class="form-check-label cur-pointer" for="switchUnggahBerkas">Unggah Berkas Surat Keluar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        @if ($apaUnggahBerkas == true)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Upload berkas sebagai</label>
                            <select class="form-select" wire:model.change="unggahBerkasSebagai">
                                <option value="">-- Pilih --</option>
                                <option value="draf">Draf</option>
                                <option value="arsip">Arsip</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            @if ($unggahBerkasSebagai == 'draf')
                                <label class="form-label fw-bold">Berkas Draf</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" wire:model="fileDraf" aria-label="Upload Draf">
                                </div>

                                <div class="form-check form-switch mt-2 mb-3 d-flex justify-content-end">
                                    <div>
                                        <input class="form-check-input cur-pointer" type="checkbox" id="kirimDrafKeKepsek" wire:model.change="kirimDrafKepsek">
                                        <label class="form-check-label cur-pointer" for="kirimDrafKeKepsek">Kirim draf ke kepala sekolah untuk diperiksa</label>
                                    </div>
                                </div>
                            @else
                                <label class="form-label fw-bold">Berkas Arsip</label>
                                <div class="input-group">
                                    <input type="file" wire:model="fileArsip" class="form-control" aria-label="Upload Arsip">
                                </div>
                            @endif
                            @error('fileDraf')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('fileArsip')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3 mt-3">
                                <label class="form-label fw-bold">Lampiran</label>
                                <input type="text" class="form-control" wire:model="lampiran" placeholder="Hyperlink lampiran google drive">
                            </div>
                            @error('lampiran')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-success" role="button" type="submit">
                    <svg class="nav-icon" style="width:15px;height:15px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
