<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="fw-bold">Profil Siswa</h5>
            <a class="btn btn-secondary btn-sm" href="/referensi/data-siswa" role="button">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-thick-left') }}"></use>
                </svg>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-secondary table-hover table-striped">
                    <tbody>
                        <livewire:components.row-detail-three :judul="'Nama'" :isi="$siswa->nama" :width="'200'" />
                        <livewire:components.row-detail-three :judul="'Jenis Kelamin'" :isi="$siswa->nipd" />
                        <livewire:components.row-detail-three :judul="'Sekolah Asal'" :isi="$siswa->sekolah_asal" />
                        <livewire:components.row-detail-three :judul="'NISN'" :isi="$siswa->nisn" />
                        <livewire:components.row-detail-three :judul="'Jenis Kelamin'" :isi="$siswa->jenis_kelamin" />
                        <livewire:components.row-detail-three :judul="'NIK'" :isi="$siswa->nik" />
                        <livewire:components.row-detail-three :judul="'Tempat, Tanggal Lahir'" :isi="$siswa->tempat_lahir.', '.$siswa->tanggal_lahir" />
                        <livewire:components.row-detail-three :judul="'Agama'" :isi="$siswa->agama_id_str" />
                        <livewire:components.row-detail-three :judul="'Alamat'" :isi="$siswa->alamat_jalan" />
                        <livewire:components.row-detail-three :judul="'Nomor Telepon'" :isi="$siswa->nomor_telepon_rumah" />
                        <livewire:components.row-detail-three :judul="'Nomor HP'" :isi="$siswa->nomor_telepon_seluler" />
                        <livewire:components.row-detail-three :judul="'Nama Ayah'" :isi="$siswa->nama_ayah" />
                        <livewire:components.row-detail-three :judul="'Pekerjaan Ayah'" :isi="$siswa->pekerjaan_ayah_id_str" />
                        <livewire:components.row-detail-three :judul="'Nama Ibu'" :isi="$siswa->nama_ibu" />
                        <livewire:components.row-detail-three :judul="'Pekerjaan Ibu'" :isi="$siswa->pekerjaan_ibu_id_str" />
                        <livewire:components.row-detail-three :judul="'Nama Wali'" :isi="$siswa->nama_wali" />
                        <livewire:components.row-detail-three :judul="'Pekerjaan Wali'" :isi="$siswa->pekerjaan_wali_id_str" />
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
        </div>
    </div>
</div>
