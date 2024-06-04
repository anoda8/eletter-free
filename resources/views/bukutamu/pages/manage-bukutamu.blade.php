<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <input type="text" class="form-control" aria-describedby="helpId" placeholder="Cari di bukutamu">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $bukutamus->links('livewire::bootstrap') }}
        </div>
    </div>
    <div class="row">
        @foreach ($bukutamus as $bukutamu)
            <div class="col-md-3 cur-pointer" wire:click="pilihBukutamu('{{ $bukutamu->id }}')" data-bs-toggle="modal" data-bs-target="#modalViewBukutamu">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <img class="card-img-top" src="/storage/bukutamu/{{ $bukutamu->created_at->year }}/{{ $bukutamu->photo_url }}" alt="Title">
                        <h5 class="fw-bold mt-2">{{ $bukutamu->nama }}</h5>
                        <span class="card-text">{{ \Str::limit($bukutamu->keperluan, 20) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $bukutamus->links('livewire::bootstrap') }}
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalViewBukutamu" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalViewBukutamu" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                @if ($bukutamuTerpilih != null)
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalViewBukutamu">Kunjungan Tamu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <img src="/storage/bukutamu/{{ $bukutamuTerpilih->created_at->year }}/{{ $bukutamuTerpilih->photo_url }}" alt="">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-secondary table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width:100px;">Nama</td>
                                        <td style="width:5px;">:</td>
                                        <td style="text-align:left;">{{ $bukutamuTerpilih->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:100px;">Jabatan</td>
                                        <td style="width:5px;">:</td>
                                        <td style="text-align:left;">{{ $bukutamuTerpilih->jabatan }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:100px;">Instansi</td>
                                        <td style="width:5px;">:</td>
                                        <td style="text-align:left;">{{ $bukutamuTerpilih->instansi }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:100px;">Alamat</td>
                                        <td style="width:5px;">:</td>
                                        <td style="text-align:left;">{{ $bukutamuTerpilih->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:100px;">Keperluan</td>
                                        <td style="width:5px;">:</td>
                                        <td style="text-align:left;">{{ $bukutamuTerpilih->keperluan }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:100px;">Bertemu</td>
                                        <td style="width:5px;">:</td>
                                        <td style="text-align:left;">{{ $bukutamuTerpilih->bertemu->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:100px;">Nomor HP</td>
                                        <td style="width:5px;">:</td>
                                        <td style="text-align:left;">{{ $bukutamuTerpilih->nomor_hp }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-sm btn-danger" wire:click="hapusBukutamu" data-bs-dismiss="modal">Hapus</a>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
