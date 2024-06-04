<?php

namespace App\FormatSurat\SuketSiswa\Pages;

use App\Models\ArsipKeluar;
use App\Models\BiodataPegawai;
use App\Models\BiodataSiswa;
use App\Models\FormatKeteranganSiswa;
use App\Models\KlasifikasiSurat;
use App\Models\ReferensiSekolah;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DetailKeteranganSiswa extends Component
{
    public $suratKeterangan;

    public $siswaTerpilih;

    #[Validate('required')]
    public $tanggalSuket, $pejabat, $namaPejabat, $nipPejabat, $kota,$ygMenerangkan, $menerangkan, $keperluan;

    #[Validate('required')]
    public $tempatLahir, $tanggalLahir, $rombel, $nipd, $nisn;

    public $nama;

    public $listNamaSiswa = [];

    public function mount($suketId = null){

        if($suketId != null){
            $this->suratKeterangan = FormatKeteranganSiswa::find($suketId);
            $this->fillDetailSuket();
        }

        $kepalaSekolah = BiodataPegawai::where('jenis_ptk_id_str', 'Kepala Sekolah')->get();

        $sekolah = ReferensiSekolah::first();
        if($kepalaSekolah != null){
            $this->pejabat = "Kepala ".$sekolah->nama;
            $this->namaPejabat = $kepalaSekolah->first()->gelar_depan." ".$kepalaSekolah->first()->nama.($kepalaSekolah->first()->gelar_belakang == null ? "" : ", ".$kepalaSekolah->first()->gelar_belakang);
            $this->nipPejabat = $kepalaSekolah->first()->nip;

            $this->ygMenerangkan = "Kepala ".$sekolah->nama." menerangkan bahwa :";
        }
        $this->menerangkan = "adalah benar-benar siswa ".$sekolah->nama." Tahun Pelajaran 2023/2024";
        $this->keperluan = "Demikian Surat Keterangan ini dibuat untuk melengkapi persyaratan administrasi pendaftaran Perguruan Tinggi";
        $this->kota = $sekolah->kabupaten_kota;
        $this->tanggalSuket = date("Y-m-d");
    }

    public function render()
    {
        if(($this->nama != null) && ($this->siswaTerpilih == null)){
            $this->listNamaSiswa = BiodataSiswa::whereAny(['nipd', 'nama'], 'LIKE', "%".$this->nama."%")->get()->take(3);
        }
        return view('format-surat.suket-siswa.pages.detail-keterangan-siswa');
    }

    public function requestArsipKeluar() : String {
        $klasifikasiSuratKeterangan = KlasifikasiSurat::where('kode', '422')->get()->first();

        $arsipKeluar = ArsipKeluar::create([
            'user_id' => auth()->user()->id,
            'perihal' => "Surat keterangan aktif a.n.".$this->nama,
            'nomor_agenda' => '-',
            'nomor_klasifikasi' => $klasifikasiSuratKeterangan->id,
            'tanggal_surat' => $this->tanggalSuket,
            'status' => 0,
            'tahun' => date("Y"),
        ]);

        return $arsipKeluar->id;
    }

    public function fillDetailSuket(){
        $this->siswaTerpilih = BiodataSiswa::where('nisn', $this->suratKeterangan->nisn)->get()->first();
        $this->nama = $this->suratKeterangan->nama;
        $this->tempatLahir = $this->suratKeterangan->tempat_lahir;
        $this->tanggalLahir = $this->suratKeterangan->tanggal_lahir;
        $this->rombel = $this->suratKeterangan->kelas;
        $this->nipd = $this->suratKeterangan->nis;
        $this->nisn = $this->suratKeterangan->nisn;
    }

    public function pilihSiswa($siswaId){
        $this->siswaTerpilih = BiodataSiswa::find($siswaId);
        $this->tempatLahir = ucfirst(strtolower($this->siswaTerpilih->tempat_lahir));
        $this->tanggalLahir = $this->siswaTerpilih->tanggal_lahir;
        $this->rombel = $this->siswaTerpilih->nama_rombel;
        $this->nipd = $this->siswaTerpilih->nipd;
        $this->nisn = $this->siswaTerpilih->nisn;
        $this->nama = $this->siswaTerpilih->nama;
        $this->reset(['listNamaSiswa']);
    }

    public function resetSiswaTerpilih(){
        $this->siswaTerpilih = null;
        $this->reset(['tempatLahir', 'tanggalLahir', 'rombel', 'nipd', 'nisn', 'nama']);
    }

    public function simpanSuket(){
        $this->validate();
        $data = [
            'nama' => $this->nama,
            'tempat_lahir' => $this->tempatLahir,
            'tanggal_lahir' => $this->tanggalLahir,
            'kelas' => $this->rombel,
            'nis' => $this->nipd,
            'nisn' => $this->nisn,
            'yang_menerangkan' => $this->ygMenerangkan,
            'menerangkan' => $this->menerangkan,
            'keperluan' => $this->keperluan,
            'tanggal_surat' => $this->tanggalSuket,
            'pejabat' => $this->pejabat,
            'nama_pejabat' => $this->namaPejabat,
            'nip_pejabat' => $this->nipPejabat,
            'kota_surat' => $this->kota
        ];

        if($this->suratKeterangan == null){
            $data['arsip_keluar_id'] = $this->requestArsipKeluar();
            $suket = FormatKeteranganSiswa::create($data);
            $this->suratKeterangan = $suket;
        }else{
            $this->suratKeterangan->update($data);
        }


        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Surat keterangan tersimpan."
        ]);
    }
}
