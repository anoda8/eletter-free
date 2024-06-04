<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="fw-bold">Foto Profil</h5>
                </div>
                <div class="card-body">
                    <form method="POST" wire:submit="uploadFoto">
                        @if (file_exists('storage/foto-profil/'.auth()->user()->id.".jpg"))
                            <div class="text-center mb-3">
                                <img class="rounded-circle" style="width:100px;" src="storage/foto-profil/{{auth()->user()->id.".jpg"}}" alt="">
                            </div>
                        @else
                            <div class="text-center mb-3">
                                <img class="rounded-circle" style="width:100px;" src="/storage/images/no-profile.png" alt="">
                            </div>
                        @endif

                        <label for="UploadFoto" class="required fw-bold">Upload Foto</label>
                        <div class="mb-3">
                            <input type="file" class="form-control" wire:model="fotoProfil" aria-label="Upload Foto">
                            @error('fotoProfil')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" href="#" role="button">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
                                </svg>
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form method="POST" wire:submit="ubahPassword">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-bold">Kata Sandi Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->username }}" aria-describedby="helpId" readonly />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold required">Password Lama</label>
                            <input type="password" class="form-control" wire:model="oldPassword" aria-describedby="helpId" placeholder="Password lama" />
                            @error('oldPassword')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold required">Password Baru</label>
                            <input type="password" class="form-control" wire:model="newPassword" aria-describedby="helpId" placeholder="Password baru" />
                            @error('newPassword')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold required">Ulangi Password Baru</label>
                            <input type="password" class="form-control" wire:model="rePassword" aria-describedby="helpId" placeholder="Ulangi password baru" />
                            @error('rePassword')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" role="button">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
