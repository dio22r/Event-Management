<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    @yield('css')

    <title>@yield('title')</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">POS</a>

            @if (Auth::check())


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse  justify-content-between" id="navbarNav">
                <ul class="navbar-nav">

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ url('/product') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/category') }}">Kategory</a>
                    </li>
                     -->
                    @can("is_registration")
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('participant*')) active @endif" href="{{ url('/participant') }}">Pendaftaran</a>
                    </li>
                    @endcan
                    @can("is_payment")
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('payment*')) active @endif" href="{{ url('/payment') }}">Pembayaran</a>
                    </li>
                    @endcan
                    @can("is_acomodation")
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('accomodation*')) active @endif" href="{{ url('/accomodation') }}">Akomodasi</a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('report*')) active @endif" href="{{ url('/report') }}">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('event*')) active @endif" href="{{ url('/event') }}">Kegiatan</a>
                    </li>
                    @can("is_presensi")
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('presensi*')) active @endif" href="{{ url('/kehadiran') }}">Kehadiran</a>
                    </li>
                    @endcan
                    @can("is_admin")
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('user*')) active @endif" href="{{ url('/user') }}">User</a>
                    </li>
                    @endcan
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('/password') }}">Ganti Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            @endif
        </div>
    </nav>
    @yield('content')

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
