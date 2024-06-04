<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @if (!auth()->user()->hasRole('siswa'))
    <div class="row">
        <div class="col-md-3">
            <livewire:desktop.widget.counter-page :color="'primary'" :textdarklight="'1'" :text="$newSuratMasuk.' Surat Masuk belum diproses, dan '.$cSuratMasuk.' belum didisposisi.'" :link="'/arsip/arsip-masuk'" :number="$newSuratMasuk.'/'.$cSuratMasuk" />
        </div>
        <div class="col-md-3">
            <livewire:desktop.widget.counter-page :color="'success'" :textdarklight="'1'" :text="$cSuratKeluar.' Surat Keluar belum diarsipkan.'" :link="'/arsip/arsip-keluar'" :number="$cSuratKeluar" />
        </div>
        <div class="col-md-3">
            <livewire:desktop.widget.counter-page :color="'info'" :text="'Disposisi Surat Masuk'" :link="'/arsip/disposisi-arsip-masuk'" />
        </div>
        <div class="col-md-3">
            <livewire:desktop.widget.counter-page :color="'dark'" />
        </div>
    </div>
    <div class="row justify-content-end mb-3">
        @if ($setting->sekilas_info)
            <livewire:desktop.widget.message-info />
        @endif
        <livewire:desktop.widget.counter-whatsapp />
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <livewire:desktop.widget.info-surat-masuk />
        </div>
        <div class="col-md-6">
            <livewire:desktop.widget.info-surat-keluar />
        </div>
    </div>
    @endif

    @if (auth()->user()->hasRole(['administrator', 'super']))
        <div class="row">
            <div class="col-md-12">
                <livewire:desktop.widget.pesan-wa-terbaru />
            </div>
        </div>
    @endif
    <div class="mb-3"></div>
        <livewire:desktop.widget.bukutamu />
    <div class="mb-3"></div>
</div>
