<div>
    {{-- Success is as dangerous as failure. --}}
    <ul class="list-group">
        <div class="disposisi-title fw-bold">
            Sifat Surat
        </div>
        <li class="list-group-item">
            <div class="disposisi-content">
                {{ strtoupper($suratMasuk->sifat_surat) }}
            </div>
        </li>
        <div class="disposisi-title fw-bold">
            Didisposisikan Ke
        </div>
        @foreach ($suratMasuk->disposisi as $dsp)
            <li class="list-group-item">
                <div class="disposisi-content">
                    {{ $dsp->pegawai->nama }}
                    @if ($dsp->jabatan != null)
                        [{{ $dsp->jabatan->nama_jabatan }}]
                    @endif
                </div>
            </li>
        @endforeach
        <div class="disposisi-title fw-bold">
            Catatan
        </div>
        <li class="list-group-item mb-2">
            <div class="disposisi-content">
                @if (count($catatans) > 0)
                    @foreach ($catatans as $catatan)
                        - {{ \App\Models\SettingCatatanDisposisi::find($catatan)->catatan }} <br />
                    @endforeach
                @endif
                @if ($suratMasuk->catatan_tambahan != null)
                    <p></p>
                    <span class="fw-bold">Tambahan Catatan : </span><br>
                    - {{ $suratMasuk->catatan_tambahan }}
                @endif
            </div>
        </li>
        <div class="d-flex justify-content-end">
            <a class="btn btn-info btn-sm disabled" role="button">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-download') }}"></use>
                </svg>
                Unduh Surat Tugas
            </a>
        </div>
    </ul>
</div>
