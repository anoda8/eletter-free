<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    @foreach ($menus as $menu)
        @if (isset($menu['nav-title']))
            @if ($menu['nav-title'] == true)
                <li class="nav-title">{{ $menu['text'] }}</li>
            @endif
            @continue
        @endif
        @if ($menu['show'])
            @if ($menu['children'] != false)
                <li class="nav-group" aria-expanded="false">
                    <a class="nav-link nav-group-toggle" href="#">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-'.$menu['icon']) }}"></use>
                        </svg>
                        {{ $menu['text'] }}
                    </a>
                    <ul class="nav-group-items" style="height: 0px;">
                        @foreach ($menu['children'] as $child)
                            @if ($child['show'])
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $child['url'] }}" target="_top">
                                        <svg class="nav-icon">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-'.$child['icon']) }}"></use>
                                        </svg>
                                        {{ $child['text'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ $menu['url'] }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-'.$menu['icon']) }}"></use>
                        </svg>
                        {{ $menu['text'] }}
                    </a>
                </li>
            @endif
        @endif
    @endforeach
</ul>

