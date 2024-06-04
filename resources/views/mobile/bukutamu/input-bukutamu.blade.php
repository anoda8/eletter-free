<div>
    {{-- The whole world belongs to you. --}}
    @if (!$terkirim)
        <div class="container">
            <form wire:submit="simpan" enctype="multipart/form-data">
                <div class="row mt-4">
                    <div class="col-md-3 col-sm-0"></div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card mb-4">
                            <div class="card-body bg-secondary mb-4 d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title text-white">Buku Tamu</h4>
                                    <h6 class="card-subtitle text-white">{{ $dataSekolah?->nama }}</h6>
                                </div>
                                <div class="image-logo">
                                    <img src="/storage/images/eletterv2.png" width="60px" alt="">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <div wire:ignore id="my_camera"></div>
                                    <div wire:ignore id="results"></div>
                                </div><br>
                                <div class="d-flex justify-content-center">
                                    <input wire:ignore type=button id="tombolFoto" value="Ambil Foto" class="btn btn-block btn-info" onClick="javascript:void(take_snapshot())">
                                    <input wire:ignore type=button id="tombolAmbilUlang" value="Ambil Ulang Foto" class="btn btn-block btn-danger" style="display:none;" onClick="javascript:void(ambil_ulang())">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Hari/Tanggal</label>
                                    <input type="text" wire:model="waktu" class="form-control" aria-describedby="helpId" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold required">Nama</label>
                                    <input type="text" placeholder="Nama" wire:model="nama" class="form-control" aria-describedby="helpId">
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold required">Jabatan/Pekerjaan</label>
                                    <input type="text" placeholder="Jabatan" wire:model="jabatan" class="form-control" aria-describedby="helpId">
                                    @error('jabatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold required">Nomor HP</label>
                                    <input type="text" placeholder="Nomor HP" wire:model="nomorHp" class="form-control" aria-describedby="helpId">
                                    @error('nomorHp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Instansi</label>
                                    <input type="text" placeholder="Instansi" wire:model="instansi" class="form-control" aria-describedby="helpId">
                                    @error('instansi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold required">Alamat</label>
                                    <textarea class="form-control" placeholder="Alamat" wire:model="alamat" rows="3"></textarea>
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold required">Keperluan</label>
                                    <textarea class="form-control" placeholder="Keperluan" wire:model="keperluan" rows="3"></textarea>
                                    @error('keperluan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <div class="fw-bold">Bertemu Dengan</div>
                                    <hr>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-action {{ $jabatanTerpilih != null ? "list-group-item-primary" : "" }} cur-pointer" data-bs-toggle="modal" data-bs-target="#modalPilihJabatan">
                                            @if ($jabatanTerpilih != null)
                                                {{ $jabatanTerpilih->pegawai->nama }} [{{ $jabatanTerpilih->jabatan->nama_jabatan }}]
                                            @else
                                            -- Pilih Jabatan --
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Cari Nama</label>
                                    <input type="text" placeholder="Cari nama" wire:model.live="cariNama" class="form-control" aria-describedby="helpId">
                                    @foreach ($listNama as $pegawai)
                                        <ul class="list-group">
                                            <li class="list-group-item list-group-item-action cur-pointer" wire:click="pilihNama('{{ $pegawai->id }}')">{{ $pegawai->nama }}</li>
                                        </ul>
                                    @endforeach
                                    @if ($namaTerpilih != null)
                                        <ul class="list-group mt-3">
                                            <li class="list-group-item list-group-item-action list-group-item-primary cur-pointer d-flex justify-content-between">
                                                <div>
                                                    {{ $namaTerpilih->nama }}
                                                </div>
                                                <span class="badge bg-danger rounded-pill cur-pointer" wire:click="hapusNama">X</span>
                                            </li>
                                        </ul>
                                    @endif
                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-send') }}"></use>
                                    </svg>
                                    Simpan & Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-0"></div>
                </div>
            </form>
        </div>
        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalPilihJabatan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalPilihJabatan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPilihJabatan">Pilih Jabatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div style="min-height:50px;max-height: 500px;overflow-x:scroll;">
                            @foreach ($listJabatan as $jabatan)
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-action cur-pointer" wire:click="pilihJabatan('{{ $jabatan->jabatanPegawai->id }}')">{{ $jabatan->nama_jabatan }}</li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-3 col-sm-0"></div>
                <div class="col-md-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="text-center">
                                <h3>Selamat Datang {{ $this->nama }}</h3>
                            </div>
                            <div class="alert alert-primary text-center" role="alert">
                                <strong>Pesan Terkirim ke {{ $this->namaTerpilih->nama }}</strong>, <br> silahkan menunggu
                            </div>
                            <div class="text-center">
                                <img class="img-fluid" src="/storage/images/3d-checklist.jpg" alt="Gambar tidak ditemukan" style="max-width: 200px;">
                            </div>
                            <div class="text-center mb-3">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-info fw-bold" wire:click="toggleSaran">Isi Kotak Saran</button>
                                </div>
                            </div>
                            @if ($showSaran)
                            <form method="POST" wire:submit="simpanSaran">
                                <div class="mb-3">
                                    <label class="form-label fw-bold required">Kotak Saran</label>
                                    <textarea class="form-control" wire:model="saran" required rows="3" placeholder="Kritik dan saran"></textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit" role="button">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-send') }}"></use>
                                        </svg>
                                        Kirim
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-0"></div>
            </div>
        </div>
    @endif
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach( '#my_camera' );


        function take_snapshot() {
            $("#results").css("display", 'block');
            $("#my_camera").css("display", 'none');
            $("#tombolAmbilUlang").css("display", 'block');
            $("#tombolFoto").css("display", 'none');

			Webcam.snap( function(data_uri){
				document.getElementById('results').innerHTML = '<img width="auto" height="auto" src="'+data_uri+'"/>';
                $("#image-tag").val(data_uri);
                console.log(data_uri);
                @this.setImageText(data_uri);
			});
		}

        function ambil_ulang(){
            $("#my_camera").css("display", 'block');
            $("#results").css("display", 'none');
            $("#tombolAmbilUlang").css("display", 'none');
            $("#tombolFoto").css("display", 'block');
        }
</script>
@endpush
