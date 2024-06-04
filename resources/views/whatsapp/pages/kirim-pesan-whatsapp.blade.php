<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <h5>Kirim Pesan Masal</h5>
                    <a href="{{ route('whatsapp.pesan-terkirim') }}" class="btn btn-sm btn-primary" wire:navigate>
                        <svg class="nav-icon" style="width:15px;height:15px;">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-closed') }}"></use>
                        </svg>
                        Daftar Pesan Terkirim
                    </a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                role="tab" aria-controls="home" aria-selected="true">Semua</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                role="tab" aria-controls="profile" aria-selected="false">Kelas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button"
                                role="tab" aria-controls="personal" aria-selected="false">Personal</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="group-tab" data-bs-toggle="tab" data-bs-target="#group" type="button"
                                role="tab" aria-controls="group" aria-selected="false">Grup</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <livewire:whatsapp.form.pesan-semua lazy />
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <livewire:whatsapp.form.pesan-kelas lazy />
                        </div>
                        <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <livewire:whatsapp.form.pesan-personal lazy />
                        </div>
                        <div class="tab-pane fade" id="group" role="tabpanel" aria-labelledby="group-tab">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt impedit non minima ullam eos cumque ab illum, qui unde reprehenderit recusandae numquam iste, ducimus facilis at. Impedit omnis voluptatibus id.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Penghitung Pesan</h5>
                </div>
                <div class="card-body">
                    <h6>1000/100000</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Siswa Terpilih</h5>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
