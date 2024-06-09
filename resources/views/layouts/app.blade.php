<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ \App\Models\SettingAplikasi::first()->aplikasi_nama == null ? "E-Letter v2" : \App\Models\SettingAplikasi::first()->aplikasi_nama }}</title>
    <meta name="theme-color" content="#ffffff">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/sass/app.scss')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <div class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <img src="/storage/images/eletterv2.png" alt="No Image">
        </div>
        <div class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <img src="/storage/images/eletterv2.png" alt="No Image">
        </div>
    </div>
    <livewire:components.sidebar-menu />
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky bg-dark mb-4">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3 text-white" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <a class="header-brand d-md-none" href="#">
                <div width="118" height="46" alt="CoreUI Logo">
                    <img src="/storage/images/eletterv2.png" alt="No Image">
                </div>
            </a>
            @if (!auth()->user()->hasRole('siswa'))
                <ul class="header-nav d-none d-md-flex">
                    <li class="nav-item"><a class="nav-link fw-bold text-white" href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
            @endif
            <ul class="header-nav ms-auto">

            </ul>
            <ul class="header-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link py-0 text-white" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                </svg>
                                {{ __('Logout') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            {{ $slot }}
        </div>
    </div>
    <footer class="footer">
        <div>
            E-Letter V2.0
            <a href="mailto:unikarunnisa@gmail.com">unikarunnisa@gmail.com</a>
        </div>
        {{-- <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/bootstrap/ui-components/">CoreUI UI
                Components</a></div> --}}
    </footer>
</div>
@livewireScripts
{{-- <script src="{{ asset('js/coreui.bundle.min.js') }}"></script> --}}
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('js/style.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
