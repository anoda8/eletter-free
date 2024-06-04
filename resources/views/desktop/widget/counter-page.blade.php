<div class="card mb-4 text-white bg-{{ $color }} bg-gradient cur-pointer" wire:click="gotoLink">
    <div class="card-body pb-0 d-flex justify-content-between align-items-start text-dark" style="min-height:140px;">
        <div>
            <div class="fs-4 fw-semibold {{ $textdarklight == "1" ? "text-white" : "" }}">
                {{ $number }}
            </div>
            <div class="{{ $textdarklight == "1" ? "text-white" : "" }}">{!! $text !!}</div>
        </div>
    </div>
    {{-- <div class="c-chart-wrapper mt-3 mx-3" style="min-height:50px;">

    </div> --}}
</div>
