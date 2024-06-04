<div>
    @isset ( $viewLink )
    <div class="text-center">
        <a href="{{ $viewLink }}" title="Tampilkan">
            <svg style="width:17px;height:17px;">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
            </svg>
        </a>
    </div>
    @endif

    @isset ( $editLink )
        <a href="{{ $editLink }}"><i class="fa-solid fa-pen-to-square me-2"></i></a>
    @endif

    @isset ( $deleteLink )
        <form
            action="{{ $deleteLink }}"
            class="d-inline"
            method="POST"
            x-data
            @submit.prevent="if (confirm('Are you sure you want to delete this item?')) $el.submit()"
        >
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-link btn-sm">
                <svg style="width:17px;height:17px;">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-trash') }}"></use>
                </svg>
            </button>
        </form>
    @endif
</div>
