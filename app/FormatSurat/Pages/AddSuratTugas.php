<?php

namespace App\FormatSurat\Pages;

use App\Models\ArsipKeluar;
use App\Models\ArsipMasuk;
use App\Models\BiodataPegawai;
use App\Models\FormatSuratTugas;
use App\Models\FormatSuratTugasPegawai;
use App\Models\JabatanPegawai;
use App\Models\KlasifikasiSurat;
use App\Models\ReferensiSekolah;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddSuratTugas extends Component
{
    public $dasarNomor, $alamat, $waktu;

    #[Validate('required')]
    public $dasarAsal, $dasarTanggal, $dasarPerihal, $dasarTujuan, $tempat, $pejabat, $namaPejabat, $nipPejabat;

    #[Validate('date')]
    public $tanggalMulai, $tanggalSelesai, $tanggalSuratTugas;

    public $arsipMasukTerpilih;

    public $mode = 'tambah';
    public $suratTugasId;

    public $cariTugasPegawai, $listPegawaiTugas = [];
    public $tugasPegawai = [], $opsiJabatanPegawai = [];

    public function mount($suratTugasId = null){
        $kepalaSekolah = BiodataPegawai::where('jenis_ptk_id_str', 'Kepala Sekolah')->get();

        $sekolah = ReferensiSekolah::first();
        if($kepalaSekolah != null){
            $this->pejabat = "Kepala ".$sekolah->nama;
            $this->namaPejabat = $kepalaSekolah->first()->gelar_depan." ".$kepalaSekolah->first()->nama.($kepalaSekolah->first()->gelar_belakang == null ? "" : ", ".$kepalaSekolah->first()->gelar_belakang);
            $this->nipPejabat = $kepalaSekolah->first()->nip;
        }
        $this->tanggalSuratTugas = date("Y-m-d");

        if($suratTugasId != null){
            $this->mode = 'edit';
            $this->suratTugasId = $suratTugasId;
            $suratTugasEdit = FormatSuratTugas::find($suratTugasId);
            $this->fillInput($suratTugasEdit);

            //tugas pegawai
            $this->fillPegawai($this->suratTugasId);
        }
    }

    public function render()
    {
        $dataListPerihal = [];
        if($this->dasarAsal != null){
            $dataListPerihal = ArsipMasuk::where('perihal', 'like' , '%'.$this->dasarAsal.'%')->get()->take(3);
        }

        if($this->cariTugasPegawai != null){
            $this->listPegawaiTugas = BiodataPegawai::with('jabatans')->where('nama', 'like', '%'.$this->cariTugasPegawai.'%')->get()->take(3);
        }
        return view('format-surat.pages.add-surat-tugas', compact('dataListPerihal'));
    }

    public function pilihDasarSurat($arsipId){
        if($this->mode == 'tambah'){
            $this->arsipMasukTerpilih = ArsipMasuk::find($arsipId);
            $this->dasarAsal = "Surat dari ".$this->arsipMasukTerpilih->asal_surat;
            $this->dasarNomor = $this->arsipMasukTerpilih->nomor_surat;
            $this->dasarTanggal = $this->arsipMasukTerpilih->tanggal_surat;
            $this->dasarPerihal = $this->arsipMasukTerpilih->perihal;
            $this->dasarTujuan = "Untuk menghadiri kegiatan ".$this->arsipMasukTerpilih->perihal;
            return;
        }
    }

    public function simpanSuratTugas(){
        $this->validate();

        if ($this->tanggalMulai > $this->tanggalSelesai) {
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Tanggal selesai kurang dari tanggal mulai."
            ]);
            return;
        }

        $data = [
            'dasar_perihal' => $this->dasarPerihal,
            'dasar_asal' => $this->dasarAsal,
            'dasar_nomor' => $this->dasarNomor,
            'dasar_tanggal' => $this->dasarTanggal,
            'kegiatan' => $this->dasarTujuan,
            'tempat_kegiatan' => $this->tempat,
            'alamat_kegiatan' => $this->alamat,
            'waktu' => $this->waktu,
            'tanggal_mulai' => $this->tanggalMulai,
            'tanggal_selesai' => $this->tanggalSelesai,
            'tanggal_surat' => $this->tanggalSuratTugas,
            'pejabat' => $this->pejabat,
            'nama_pejabat' => $this->namaPejabat,
            'nip_pejabat' => $this->nipPejabat,
            'user_id' => auth()->user()->id,
        ];

        $suratTugas = $redirect = null;
        if ($this->arsipMasukTerpilih != null) {
            $data['arsip_masuk_id'] = $this->arsipMasukTerpilih->id;
        }
        if($this->mode == 'tambah'){
            $data['surat_keluar_id'] = $this->requestArsipKeluar();
            $suratTugas = FormatSuratTugas::create($data);
            $redirect = '/format-surat/tambah-surat-tugas/'.$suratTugas->id;
        }else{
            $suratTugas = FormatSuratTugas::find($this->suratTugasId);
            $suratTugas->update($data);
            $redirect = '/format-surat/tambah-surat-tugas/'.$this->suratTugasId;
        }
        $this->savePegawai($suratTugas->id);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Surat tugas tersimpan."
        ]);
        $this->redirect($redirect);

    }

    public function requestArsipKeluar() : String {
        $klasifikasiSuratTugas = KlasifikasiSurat::where('kode', '094')->get()->first();

        $arsipKeluar = ArsipKeluar::create([
            'user_id' => auth()->user()->id,
            'perihal' => $this->dasarPerihal,
            'nomor_agenda' => '-',
            'nomor_klasifikasi' => $klasifikasiSuratTugas->id,
            'tanggal_surat' => $this->tanggalSuratTugas,
            'status' => 0,
            'tahun' => date("Y"),
        ]);

        return $arsipKeluar->id;
    }

    public function fillInput(FormatSuratTugas $suratTugas){
        $this->arsipMasukTerpilih = ArsipMasuk::find($suratTugas->arsip_masuk_id);
        $this->dasarAsal = $suratTugas->dasar_asal;
        $this->dasarNomor = $suratTugas->dasar_nomor;
        $this->dasarTanggal = $suratTugas->dasar_tanggal;
        $this->dasarPerihal = $suratTugas->dasar_perihal;
        $this->dasarTujuan = $suratTugas->kegiatan;
        $this->tempat = $suratTugas->tempat_kegiatan;
        $this->alamat = $suratTugas->alamat_kegiatan;
        $this->tanggalMulai = $suratTugas->tanggal_mulai;
        $this->tanggalSelesai = $suratTugas->tanggal_selesai;
        $this->waktu = $suratTugas->waktu;
        $this->tanggalSuratTugas = $suratTugas->tanggal_surat;
        $this->pejabat = $suratTugas->pejabat;
        $this->namaPejabat = $suratTugas->nama_pejabat;
        $this->nipPejabat = $suratTugas->nip_pejabat;
    }

    public function fillPegawai($suratTugasId){
        $tugasPegawai = FormatSuratTugasPegawai::with(['jabatan'])->where('fromat_surat_tugas_id', $suratTugasId)->get();
        foreach ($tugasPegawai as $key => $tgsPgw) {
            $this->tugasPegawai[] = JabatanPegawai::with(['pegawai'])->find($tgsPgw->jabatan_pegawai_id);
        }
    }

    public function showListJabatanPegawai($pegawaiId){
        $this->opsiJabatanPegawai = JabatanPegawai::where('biodata_pegawai_id', $pegawaiId)->get();
    }

    public function addPegawai($pegawaiId){
        $jbtPegawai = JabatanPegawai::with(['pegawai'])->find($pegawaiId);
        if($jbtPegawai == null){
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Pegawai tersebut belum memiliki jabatan."
            ]);
            $this->reset(['cariTugasPegawai', 'listPegawaiTugas']);
            return;
        }
        $this->dispatch('close-modal', ['modalName' => "modalPilihJabatan"]);
        $this->tugasPegawai[] = $jbtPegawai;
        $this->reset(['cariTugasPegawai', 'listPegawaiTugas']);
    }

    public function delPegawai($pegawaiId){
        foreach ($this->tugasPegawai as $key => $pgw) {
            if ($pgw->id == $pegawaiId) {
                if($this->suratTugasId != null){
                    FormatSuratTugasPegawai::where([
                        'fromat_surat_tugas_id' => $this->suratTugasId,
                        'jabatan_pegawai_id' => $pgw->id,
                    ])->delete();
                }
                unset($this->tugasPegawai[$key]);
            }
        }
    }

    public function savePegawai($formatSuratTugasId){
        foreach ($this->tugasPegawai as $key => $pgw) {
            FormatSuratTugasPegawai::firstOrNew([
                'fromat_surat_tugas_id' => $formatSuratTugasId,
                'biodata_pegawai_id' => $pgw->pegawai->id,
                'jabatan_pegawai_id' => $pgw->id
            ])->save();
        }
    }
}
