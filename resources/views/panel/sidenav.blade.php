<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <a class="nav-link @if (Request::is('*dashboard')) active @endif" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <!-- <div class="sb-sidenav-menu-heading">Master</div> -->

                @can("view-any", new App\User())
                <a class="nav-link @if (Request::is('user*')) active @endif" href="{{ url('/user') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    User
                </a>
                @endcan

                <a class="nav-link @if (Request::is('participant*')) active @endif" href="{{ url('/participant') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Pendaftaran
                </a>

                @can("view-any", new App\ThPayment())
                <a class="nav-link @if (Request::is('payment*')) active @endif" href="{{ url('/payment') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Pembayaran
                </a>
                @endcan
                @can("view-any", new App\ThAccomodation())
                <a class="nav-link @if (Request::is('accomodation*')) active @endif" href="{{ url('/accomodation') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Akomodasi
                </a>
                @endcan

                <a class="nav-link @if (Request::is('event*')) active @endif" href="{{ url('/event') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Kegiatan
                </a>

                <a class="nav-link @if (Request::is('report*')) active @endif" href="{{ url('/report') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Laporan
                </a>

                @can("is_presensi")
                <a class="nav-link @if (Request::is('presensi*')) active @endif" href="{{ url('/kehadiran') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Kehadiran
                </a>
                @endcan

            </div>
        </div>
    </nav>
</div>
