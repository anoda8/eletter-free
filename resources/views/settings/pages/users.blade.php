<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-info btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiGenerateUserSiswa">
                    <svg style="width:17px;height:17px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-truck') }}"></use>
                    </svg>&nbsp;Generate User Siswa</a>&nbsp;
                <a class="btn btn-success btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiGenerateUserPegawai">
                    <svg style="width:17px;height:17px;">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-truck') }}"></use>
                    </svg>&nbsp;Generate User Pegawai</a>&nbsp;
            </div>
            <livewire:settings.tables.users />
        </div>
    </div>
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="modalKonfirmasiGenerateUserPegawai" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalKonfirmasiGenerateUserPegawai" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiGenerateUserPegawai">Konfirmasi Generate User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan membuat user dari Biodata Pegawai ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" wire:loading.attr="disabled">Batal</button>
                    <button type="button" class="btn btn-sm btn-success" wire:click="generatePegawai" wire:loading.attr="disabled">
                        Generate
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalKonfirmasiGenerateUserSiswa" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalKonfirmasiGenerateUserSiswa" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiGenerateUserSiswa">Konfirmasi Generate User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan membuat user dari Biodata Siswa ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" wire:loading.attr="disabled">Batal</button>
                    <button type="button" class="btn btn-sm btn-success" wire:click="generateSiswa" wire:loading.attr="disabled">
                        Generate
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
