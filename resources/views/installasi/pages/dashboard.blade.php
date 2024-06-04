<div style="margin-top: 100px;">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="mb-5 fw-bold">Installasi E-Letter</h3>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="database">
            <button class="nav-link {{ $mode == 'database' ? "active bg-primary text-white fw-bold" : "disabled" }}" id="database-tab" data-bs-toggle="tab" data-bs-target="#database" type="button"
                role="tab" aria-controls="database" aria-selected="true">1. Pengaturan Database</button>
        </li>
        <li class="nav-item" role="user">
            <button class="nav-link {{ $mode == 'user' ? "active bg-primary text-white fw-bold" : "disabled" }}" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button"
                role="tab" aria-controls="user" aria-selected="false">2. User Administrator</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $mode == 'dapodik' ? "active bg-primary text-white fw-bold" : "disabled" }}" id="dapodik-tab" data-bs-toggle="tab" data-bs-target="#dapodik" type="button"
                role="tab" aria-controls="dapodik" aria-selected="false">3. Koneksi Dapodik</button>
        </li>
        <li class="nav-item" role="finish">
            <button class="nav-link {{ $mode == 'finish' ? "active bg-primary text-white fw-bold" : "disabled" }}" id="finish-tab" data-bs-toggle="tab" data-bs-target="#finish" type="button"
                role="tab" aria-controls="finish" aria-selected="false">4. Akhir Proses</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent" style="margin-bottom:120px;">
        <div class="tab-pane {{ $mode == 'database' ? "fade show active" : "fade"}}" id="database" role="tabpanel" aria-labelledby="database-tab">
            @if ($mode == 'database')
                <livewire:installasi.pages.pengaturan-database />
            @endif
        </div>
        <div class="tab-pane {{ $mode == 'user' ? "fade show active" : "fade"}}" id="user" role="tabpanel" aria-labelledby="user-tab">
            @if ($mode == 'user')
                <livewire:installasi.pages.user-administrator />
            @endif
        </div>
        <div class="tab-pane {{ $mode == 'dapodik' ? "fade show active" : "fade"}}" id="dapodik" role="tabpanel" aria-labelledby="dapodik-tab">
            @if ($mode == 'dapodik')
                <livewire:installasi.pages.koneksi-dapodik />
            @endif
        </div>
        <div class="tab-pane {{ $mode == 'finish' ? "fade show active" : "fade"}}" id="finish" role="tabpanel" aria-labelledby="finish-tab">
            @if ($mode == 'finish')
                <livewire:installasi.pages.akhiri-proses />
            @endif
        </div>
    </div>
</div>
