<div>
    {{-- In work, do what you enjoy. --}}
    <div class="card border-info">
        @if ($pesan != null)
            <div class="card-body">
                <a href="{{ route('whatsapp.riwayat-pesan') }}">
                    <h6 class="card-title fw-bold">Pesan Whatsapp Terbaru</h6>
                </a>
                <div class="table-responsive">
                    <table class="table {{ $pesan->status == 0 ? "table-warning" : "table-info" }} table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-dark">{{ $pesan->nomor }}</td>
                                <td class="text-dark">{{ \Str::limit($pesan->pesan, 100) }}</td>
                                <td class="text-dark">{{ $pesan->kelompok }}</td>
                                <td class="text-dark">{{ $pesan->status == 0 ? "Gagal" : "Terkirim" }}</td>
                                <td class="text-dark">{{ $pesan->log_message }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
