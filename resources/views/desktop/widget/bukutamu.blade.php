<div class="row">
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @foreach ($bukutamus as $bukutamu)
    <div class="col-md-2">
        <div class="card bg-secondary">
            <div class="card-body">
                <img class="card-img-top" src="/storage/bukutamu/{{ $bukutamu->created_at->year }}/{{ $bukutamu->photo_url }}" alt="Title">
            </div>
        </div>
    </div>
    @endforeach
</div>
