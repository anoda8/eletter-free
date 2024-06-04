<div>
    {{-- Be like water. --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="fw-bold">Pencadangan Surat Keluar</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Tahun</label>
                        <select class="form-select" wire:model.live="selectTahun">
                            <option selected>= Pilih =</option>
                            @foreach ($listTahun as $tahun)
                                <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($selectTahun != null)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Bulan</label>
                            <select class="form-select" wire:model.live="selectBulan">
                                <option selected>= Pilih =</option>
                                @foreach ($listBulan as $key => $bulan)
                                    <option value="{{ $key }}">{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                    @endif
                    @if ($selectBulan != null)
                        <div class="d-flex justify-content-between">
                            <div class="fw-bold">
                                Pencadangan Terpilih {{ $listBulan[$selectBulan] }} {{ $selectTahun }}
                            </div>
                            <a wire:click="countArsipKeluar" class="btn btn-success btn-sm" role="button">Hitung</a>
                        </div>
                    @endif
                </div>
                <div class="col">
                    @if (count($counterSurkel) > 0)
                        <div class="alert alert-warning text-dark mb-3" role="alert">
                            <strong>Terdapat {{ count($counterSurkel) }} surat keluar</strong>
                        </div>
                    @endif
                    @if (count($counterSurkel) > 0)
                        <div class="col d-flex justify-content-end">
                            <a class="btn btn-danger btn-sm" wire:click="doBackup" role="button">Backup</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
