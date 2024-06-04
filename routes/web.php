<?php

use App\Http\Controllers\PdfViewer;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Desktop\Pages\Dashboard::class)->middleware(['auth']);

Auth::routes();
Route::get('/register', function() {
    return redirect('/login');
})->name('register');

Route::get('/home', function() {
    return redirect('/dashboard');
})->name('home');

Route::get('/installasi', App\Installasi\Pages\Dashboard::class)->name('installasi.pilih-mode');
Route::get('/installasi/mode-migration', App\Installasi\Pages\Migration::class)->name('installasi.mode-migration');
Route::get('/installasi/mode-user', App\Installasi\Pages\Dashboard::class)->name('installasi.mode-user');
Route::get('/installasi/mode-dapodik', App\Installasi\Pages\Dashboard::class)->name('installasi.mode-dapodik');
Route::get('/installasi/mode-finish', App\Installasi\Pages\Dashboard::class)->name('installasi.mode-finish');

Route::get('/login/pegawai-info', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('loginpegawai-info');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
});

Route::group(['prefix' => 'arsip', 'middleware' => ['auth']], function() {
    Route::get('/arsip-masuk', \App\Arsip\Pages\ArsipMasuk::class)->name('arsip.masuk');
    Route::get('/unggah-arsip-masuk', \App\Arsip\Pages\UploadArsipMasuk::class)->name('arsip.masuk-upload');
    Route::get('/input-arsip-masuk/{fileMasukId}', \App\Arsip\Pages\InputArsipMasuk::class)->name('arsip.masuk-input');
    Route::get('/detail-arsip-masuk/{arsipMasukId}', \App\Arsip\Pages\DetailArsipMasuk::class)->name('arsip.masuk-detail');
    Route::get('/disposisi-arsip-masuk', \App\Arsip\Pages\DisposisiArsipMasuk::class)->name('arsip.disposisi-arsip-masuk');
    Route::get('/disposisi-arsip-masuk-cetak/{arsipMasukId}', [\App\Arsip\Pages\DetailArsipMasuk::class, 'cetak'])->name('arsip.disposisi-arsip-masuk-cetak');

    //arsip keluar
    Route::get('/arsip-keluar', \App\Arsip\Pages\ArsipKeluar::class)->name('arsip.keluar');
    Route::get('/unggah-arsip-keluar', \App\Arsip\Pages\UploadArsipKeluar::class)->name('arsip.keluar-upload');
    Route::get('/detail-arsip-keluar/{arsipKeluarId}', \App\Arsip\Pages\DetailArsipKeluar::class)->name('arsip.keluar-detail');
});

Route::group(['prefix' => 'format-surat', 'middleware' => ['auth']], function() {
    Route::get('/surat-tugas', \App\FormatSurat\Pages\SuratTugas::class)->name('format.surat-tugas');
    Route::get('/cetak-surat-tugas/{suratTugasId}', [\App\FormatSurat\Pages\CetakSuratTugas::class, 'cetak'])->name('format.cetak-surat-tugas');
    Route::get('/tambah-surat-tugas', \App\FormatSurat\Pages\AddSuratTugas::class)->name('format.tambah-surat-tugas');
    Route::get('/tambah-surat-tugas/{suratTugasId}', \App\FormatSurat\Pages\AddSuratTugas::class)->name('format.edit-surat-tugas');
    Route::get('/surat-keterangan-siswa', \App\FormatSurat\SuketSiswa\Pages\KeteranganSiswa::class)->name('format.surat-keterangan-siswa');
    Route::get('/detail-keterangan-siswa', \App\FormatSurat\SuketSiswa\Pages\DetailKeteranganSiswa::class)->name('format.detail-keterangan-siswa');
    Route::get('/detail-keterangan-siswa/{suketId?}', \App\FormatSurat\SuketSiswa\Pages\DetailKeteranganSiswa::class)->name('format.detail-keterangan-siswa');
    Route::get('/cetak-keterangan-siswa/{suketId}', [\App\FormatSurat\SuketSiswa\Pages\CetakKeteranganSiswa::class, 'cetak'])->name('format.cetak-keterangan-siswa');
});

Route::group(['prefix' => 'databases', 'middleware' => ['auth']], function() {
    Route::get('/klasifikasi-surat', \App\Databases\Pages\KlasifikasiSurat::class)->name('settings.klasifikasi-surat');
    Route::get('/biodata-pegawai', \App\Databases\Pages\BiodataPegawaiPage::class)->name('settings.biodata-pegawai');
    Route::get('/biodata-pegawai/{pegawaiId}', \App\Databases\Pages\BiodataPegawaiView::class)->name('settings.biodata-pegawai-view');
    Route::get('/biodata-siswa', \App\Databases\Pages\BiodataSiswaPage::class)->name('settings.biodata-siswa');
    Route::get('/biodata-siswa/{siswaId}', \App\Databases\Pages\BiodataSiswaView::class)->name('settings.biodata-siswa-view');
});

Route::group(['prefix' => 'settings', 'middleware' => ['auth']], function() {
    Route::get('/koneksi-dapodik', \App\Settings\Pages\KoneksiDapodik::class)->name('settings.koneksi-dapodik');
    Route::get('/sinkronisasi-dapodik', \App\Settings\Pages\SinkronisasiDapodik::class)->name('settings.sinkronisasi-dapodik');
    Route::get('/catatan-disposisi', \App\Settings\Pages\CatatanDisposisi::class)->name('settings.catatan-disposisi');
    Route::delete('/hapus-catatan/{catatanId}', [\App\Settings\Pages\CatatanDisposisi::class, 'deleteRecord'])->name('settings.hapus-catatan');
    Route::get('/jabatan', \App\Settings\Pages\Jabatan::class)->name('settings.jabatan');
    Route::delete('/hapus-jabatan/{jabatanId}', [\App\Settings\Pages\Jabatan::class, 'deleteRecord'])->name('settings.hapus-jabatan');
    Route::get('/users', \App\Settings\Pages\Users::class)->name('settings.users');
    Route::get('/users/{userId}', \App\Settings\Pages\UserDetail::class)->name('settings.users-detail');
    Route::delete('/hapus-user/{userId}', [\App\Settings\Pages\Users::class, 'deleteRecord'])->name('settings.hapus-user');
    //aplikasi
    Route::get('/aplikasi', \App\Settings\Pages\SettingAplikasi::class)->name('settings.aplikasi');
});

Route::group(['prefix' => 'referensi', 'middleware' => ['auth']], function() {
    Route::get('/data-sekolah', \App\Referensi\Pages\DataSekolah::class)->name('referensi.data-sekolah');
    Route::get('/data-gtk', \App\Referensi\Pages\DataGtk::class)->name('referensi.data-gtk');
    Route::get('/profil-gtk/{gtkId}', \App\Referensi\Pages\ProfilGtk::class)->name('referensi.profil-gtk');
    Route::get('/data-siswa', \App\Referensi\Pages\DataSiswa::class)->name('referensi.data-siswa');
    Route::get('/profil-siswa/{siswaId}', \App\Referensi\Pages\ProfilSiswa::class)->name('referensi.profil-siswa');
});

Route::group(['prefix' => 'whatsapp', 'middleware' => ['auth']], function() {
    Route::get('/daftar-registrasi-nomor', \App\Whatsapp\Pages\RegistrasiNomor::class)->name('whatsapp.daftar-registrasi-nomor');
    Route::get('/kirim-pesan-wa', \App\Whatsapp\Pages\KirimPesanWhatsapp::class)->name('whatsapp.kirim-pesan');
    Route::get('/pesan-wa-terkirim', \App\Whatsapp\Pages\PesanWhatsappTerkirim::class)->name('whatsapp.pesan-terkirim');
    Route::get('/riwayat-pesan', \App\Whatsapp\Pages\RiwayatPesan::class)->name('whatsapp.riwayat-pesan');
});

Route::group(['prefix' => 'izin-akses', 'middleware' => ['auth']], function() {
    Route::get('/permission', \App\IzinAkses\Permission::class)->name('izin-akses.permission');
    Route::get('/permission/{permissionId}', \App\IzinAkses\Permission::class)->name('izin-akses.permission-view');
    Route::delete('/permission/{permissionId}/hapus', [\App\IzinAkses\Permission::class, 'delete'])->name('izin-akses.permission-delete');
    Route::get('/roles', \App\IzinAkses\Roles::class)->name('izin-akses.roles');
    Route::get('/roles/{roleId}', \App\IzinAkses\RolesView::class)->name('izin-akses.roles-view');
    Route::delete('/roles/{roleId}/hapus', [\App\IzinAkses\Roles::class, 'delete'])->name('izin-akses.roles-delete');
});

Route::group(['prefix' => 'backup', 'middleware' => ['auth']], function() {
    Route::get('/arsip-masuk', \App\Backup\Pages\ArsipMasuk\BackupArsipMasuk::class)->name('backup.arsip-masuk');
    Route::get('/arsip-keluar', \App\Backup\Pages\ArsipKeluar\BackupArsipKeluar::class)->name('backup.arsip-keluar');
});

Route::group(['prefix' => 'addons', 'middleware' => ['auth']], function() {
    Route::get('/bukutamu-manage', \App\Bukutamu\Pages\ManageBukutamu::class)->name('addons.bukutamu-manage');
    Route::get('/pengumuman-lulus', \App\PengumumanLulus\Pages\UploadFile::class)->name('addons.pengumuman-lulus-upload');
    Route::get('/pengumuman-lulus/{pengLulusId}', \App\PengumumanLulus\Pages\DetailSiswa::class)->name('addons.pengumuman-lulus-detail');
    Route::get('/setting-pengumuman-lulus', \App\PengumumanLulus\Pages\Pengaturan::class)->name('addons.pengaturan-pengumuman-lulus');
    Route::get('/setting-pengumuman-lulus/{pengLulusId}', \App\PengumumanLulus\Pages\DetailPengaturan::class)->name('addons.detail-pengaturan-pengumuman-lulus');
});

Route::get('/registrasi-nomor/{biodataSiswaId}', \App\Mobile\Pages\RegistrasiNomorWhatsapp::class)->name('whatsapp.registrasi-nomor');
Route::get('/verifikasi-akun-siswa', \App\Mobile\Pages\VerifikasiUserSiswa::class)->name('mobile.verifikasi-user-siswa');
Route::get('/verifikasi-akun-siswa/pengumuman-kelulusan', \App\Mobile\Pages\VerifikasiUserSiswa::class)->name('mobile.verifikasi-user-siswa-pengumuman-lulus');

Route::get('/dashboard', \App\Desktop\Pages\Dashboard::class)->name('dashboard')->middleware(['auth']);
Route::get('/profile', \App\Desktop\Pages\Profile::class)->name('profile')->middleware(['auth']);

//disposisi
Route::get('/disposisi-kepsek/{suratMasukId}', \App\Mobile\Pages\DisposisiKepsek::class)->name('mobile.disposisi-kepsek');
Route::get('/disposisi-pegawai-view/{suratMasukId}', \App\Mobile\Pages\DisposisiKepsek::class)->name('mobile.disposisi-pegawai-view');
Route::get('/disposisi-pegawai-detail/{suratMasukId}', \App\Mobile\Pages\DisposisiKepsek::class)->name('mobile.disposisi-pegawai-detail')->middleware('auth');
Route::get('/disposisi-kepsek-terkirim', \App\Mobile\Pages\DisposisiKepsekTerkirim::class)->name('mobile.disposisi-kepsek-terkirim');
Route::get('/disposisi-kepsek-daftar', \App\Mobile\Pages\DisposisiKepsekDaftar::class)->name('mobile.disposisi-kepsek-daftar');
Route::get('/disposisi-pegawai-daftar', \App\Mobile\Pages\DisposisiPegawaiDaftar::class)->name('mobile.disposisi-pegawai-daftar')->middleware(['auth']);
Route::get('/pdfviewer/{pdf}', [PdfViewer::class, 'index']);

//setting super
Route::get('/setting-super', \App\Settings\Pages\SettingAplikasiSuper::class)->name('setting.super')->middleware(['role:super']);


//AddOns
//--BukuTamu
Route::get('/bukutamu', \App\Mobile\Bukutamu\InputBukutamu::class)->name('bukutamu');
