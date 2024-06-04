<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="card">
        <div class="card-header bg-primary text-white fw-bold">
            Surat masuk {{ $tanggal }}
        </div>
        <div class="card-body">
            @foreach ($suratMasuk as $srtMasuk)
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action">{{ $srtMasuk->perihal }}</li>
                </ul>
            @endforeach
        </div>
    </div>
</div>
