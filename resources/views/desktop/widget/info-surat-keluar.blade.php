<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="card">
        <div class="card-header bg-success text-white fw-bold">
            Surat keluar {{ \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat("l, d F Y") }}
        </div>
        <div class="card-body">
            @foreach ($suratKeluar as $srtKeluar)
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action">{{ $srtKeluar->perihal }}</li>
                </ul>
            @endforeach
        </div>
    </div>
</div>
