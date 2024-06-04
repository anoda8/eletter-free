<div>
    {{-- The whole world belongs to you. --}}
    <form method="POST" wire:submit="simpanUser">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5 class="fw-bold">Detail User {{ $user->name }}</h5>
                <a class="btn btn-secondary btn-sm" href="/settings/users" role="button" wire:navigate>
                    <svg class="nav-icon" style="width:15px;height:15px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
                    </svg>
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama</label>
                            <input type="text" value="{{ $user->name }}" class="form-control" disabled aria-describedby="helpId" placeholder="nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" value="{{ $user->username }}" class="form-control" disabled aria-describedby="helpId" placeholder="nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="text" value="{{ $user->email }}" class="form-control" disabled aria-describedby="helpId" placeholder="nama">
                        </div>
                        @if (!$isPegawai)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Level</label>
                                <input type="text" value="{{ $user->roles->first()?->name }}" class="form-control" disabled aria-describedby="helpId" placeholder="nama">
                            </div>
                        @else
                            <label class="form-label fw-bold">Level</label>
                            <div class="input-group mb-3">
                                <input type="text" value="@foreach ($user->roles as $userRole){{ $userRole->name }},&nbsp; @endforeach" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" readonly>
                                <a class="btn btn-success" role="button" data-bs-toggle="modal" data-bs-target="#modalTambahLevel">
                                    <svg class="nav-icon" style="width:15px;height:15px;">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                                    </svg>&nbsp;
                                    Tambah Level
                                </a>
                            </div>
                            @foreach ($user->roles as $userRole)
                                <a class="btn btn-danger btn-sm" wire:click="selectDeleteLevel('{{ $userRole->name }}')" role="button" data-bs-toggle="modal" data-bs-target="#konfirmasiHapusLevel">{{ $userRole->name }} X</a>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="row">

                            @if (auth()->user()->isAbleTo('menu-izin-akses') && (!$user->hasRole('siswa')))
                                @foreach ($listPermission as $permission)
                                    <div class="col-md-6">
                                        @foreach ($permission as $prms)
                                        <div class="form-check">
                                            <input class="form-check-input" wire:model="userPermissions" value="{{ $prms->name }}" type="checkbox">
                                            <label class="form-check-label">
                                                {{ $prms->display_name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#konfirmasiResetPassword">
                    <svg style="width:17px;height:17px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-sync') }}"></use>
                    </svg>
                    &nbsp;
                    Reset Password
                </button>&nbsp;&nbsp;
                <button type="submit" class="btn btn-success" role="button">
                    <svg style="width:17px;height:17px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                    </svg>
                    Simpan
                </button>
            </div>
        </div>
    </form>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="konfirmasiResetPassword" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalKonfirmasiResetPassword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiResetPassword">Konfirmasi Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan mengatur ulang password ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click="aturUlangPassword">Reset Password</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalTambahLevel" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTambahLevel" aria-hidden="true">
        <form method="POST" wire:submit="addLevel">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLevel">Tambah Level</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($roles != null)
                            <div class="mb-3">
                                <select class="form-select" wire:model.change="level">
                                    <option selected>-- Pilih Level --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ ucwords($role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-success">Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="konfirmasiHapusLevel" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="konfirmasiHapusLevel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="konfirmasiHapusLevel">Konfirmasi Hapus Level</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($levelDelete != null)
                        Apakah anda yakin akan menghapus level {{ ucwords($levelDelete) }} dari user {{ $user->name }} ?
                    @else
                        Loading...
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-danger" wire:click="deleteLevel">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

