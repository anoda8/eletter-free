<div class="col-md-9">
    <div class="card border-info">
      <div class="card-body">
        <span class="card-text">
            @if (auth()->user()->hasRole($showMessage->user))
                <h6 class="fw-bold">Informasi</h6>
                {!! $showMessage->pesan !!}
            @endif
        </span>
      </div>
    </div>
</div>
