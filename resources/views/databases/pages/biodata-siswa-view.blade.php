<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="card mb-3">
        <form method="POST" wire:submit="simpanDtSiswa">
            <div class="card-header d-flex justify-content-between">
                <h5 class="fw-bold">{{ $siswa->nama }} [{{ $siswa->nama_rombel }}]</h5>
                <div>
                    <a class="btn btn-secondary btn-sm" href="{{ route('settings.biodata-siswa') }}" role="button">
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
                        <div class="table-responsive">
                            <table class="table table-secondary table-hover table-striped">
                                <tbody>
                                    <livewire:components.row-detail-three :judul="'Nama'" :isi="$siswa->nama" :width="'200'" />
                                    <livewire:components.row-detail-three :judul="'NIS'" :isi="$siswa->nipd" />
                                    <livewire:components.row-detail-three :judul="'Sekolah Asal'" :isi="$siswa->sekolah_asal" />
                                    <livewire:components.row-detail-three :judul="'NISN'" :isi="$siswa->nisn" />
                                    <livewire:components.row-detail-three :judul="'Jenis Kelamin'" :isi="$siswa->jenis_kelamin" />
                                    <livewire:components.row-detail-three :judul="'NIK'" :isi="$siswa->nik" />
                                    <livewire:components.row-detail-three :judul="'Tempat, Tanggal Lahir'" :isi="$siswa->tempat_lahir.', '.$siswa->tanggal_lahir" />
                                    <livewire:components.row-detail-three :judul="'Agama'" :isi="$siswa->agama_id_str" />
                                    <livewire:components.row-detail-three :judul="'Alamat'" :isi="$siswa->alamat_jalan" />
                                    <livewire:components.row-detail-three :judul="'Nama Ayah'" :isi="$siswa->nama_ayah" />
                                    <livewire:components.row-detail-three :judul="'Pekerjaan Ayah'" :isi="$siswa->pekerjaan_ayah_id_str" />
                                    <livewire:components.row-detail-three :judul="'Nama Ibu'" :isi="$siswa->nama_ibu" />
                                    <livewire:components.row-detail-three :judul="'Pekerjaan Ibu'" :isi="$siswa->pekerjaan_ibu_id_str" />
                                    <livewire:components.row-detail-three :judul="'Nama Wali'" :isi="$siswa->nama_wali" />
                                    <livewire:components.row-detail-three :judul="'Pekerjaan Wali'" :isi="$siswa->pekerjaan_wali_id_str" />
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-secondary table-hover table-striped">
                                <tbody>
                                    <livewire:components.row-detail-three :judul="'Anak ke'" :isi="$siswa->anak_keberapa" />
                                    <livewire:components.row-detail-three :judul="'Tinggi Badan'" :isi="$siswa->tinggi_badan" />
                                    <livewire:components.row-detail-three :judul="'Berat Badan'" :isi="$siswa->berat_badan" />
                                    <livewire:components.row-detail-three :judul="'Email'" :isi="$siswa->email" />
                                    <livewire:components.row-detail-three :judul="'Kelas'" :isi="$siswa->nama_rombel" />
                                    <livewire:components.row-detail-three :judul="'Kurikulum'" :isi="$siswa->kurikulum_id_str" />
                                    <livewire:components.row-detail-three :judul="'Berkebutuhan khusus'" :isi="$siswa->kebutuhan_khusus" />
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor Telp Rumah</label>
                            <input type="text" class="form-control" wire:model="nomorTelp" aria-describedby="helpId" placeholder="Nomor Telp Rumah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor HP</label>
                            <input type="text" class="form-control" wire:model="nomorHp" aria-describedby="helpId" placeholder="Nomor Telp Rumah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor HP Orang Tua/Wali</label>
                            <input type="text" class="form-control" wire:model="nomorHpOrtu" aria-describedby="helpId" placeholder="Nomor Telp Rumah">
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm" role="button">Simpan</button>
            </div>
        </form>
    </div>
</div>
