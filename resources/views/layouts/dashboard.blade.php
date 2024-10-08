<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    @if ($logo)
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $logo->profile_photo) }}">
    @else
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/Logo.png') }}">
    @endif
    <title>@yield('title') | Aplikasi Pembayaran SPP</title>
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    @yield('plugin')

</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    @include('sweetalert::alert')
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="navbar-brand" href="{{ url('/dashboard') }}">
                        <span class="logo-text">
                            <i></i>Aplikasi Pembayaran SPP
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <a class="navbar-brand" href="{{ url('/dashboard') }}">
                        </a>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <div class="user-profile d-flex no-block dropdown m-t-20">
                                @if ($logo)
                                    <div class="user-pic"><img src="{{ asset('storage/' . $logo->profile_photo) }}"
                                            alt="users" class="rounded-circle" width="40" /></div>
                                @else
                                    <div class="user-pic"><img src="{{ url('assets/images/Logo.png') }}" alt="users"
                                            class="rounded-circle" width="40" /></div>
                                @endif
                                <div class="user-content hide-menu m-l-10">
                                    <a href="javascript:void(0)" class="" id="Userdd" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <h5 class="m-b-0 user-name font-medium">{{ $user->name }}<i
                                                class="ml-2 fa fa-angle-down"></i></h5>
                                        <span class="op-5 user-email">{{ $user->email }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                                class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('dashboard') }}" aria-expanded="false"><i
                                    class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        @if (auth()->user()->level == 'admin')
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('dashboard/data-siswa') }}" aria-expanded="false">
                                    <i class="mdi mdi-account-multiple-outline"></i>
                                    <span class="hide-menu">Data Siswa</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('dashboard/data-petugas') }}" aria-expanded="false">
                                    <i class="mdi mdi-account-multiple"></i>
                                    <span class="hide-menu">Data Petugas</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('dashboard/data-kelas') }}" aria-expanded="false">
                                    <i class="mdi mdi-school"></i>
                                    <span class="hide-menu">Data Kelas</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                                    aria-expanded="false" data-toggle="collapse"
                                    data-target="#PengaturanNominalDropdown"
                                    aria-controls="PengaturanNominalDropdown">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                    <span class="hide-menu">Pengaturan Nominal</span for="PengaturanNominalDropdown">
                                    <i class="mdi mdi-chevron-down float-right"></i>
                                </a>
                                <ul id="PengaturanNominalDropdown" class="collapse first-level"
                                    aria-expanded="false">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('dashboard/data-spp') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data SPP</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/data-ujian') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data Ujian</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/data-bekal') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data Bekal</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/data-potab') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data Potab</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/data-ijazah') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data Ijazah</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/data-kegiatan') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data Kegiatan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/data-drumband') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data Drumband</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/data-outbond') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data Outbond</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/data-daftar-ulang') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-usd"></i>
                                            <span class="hide-menu">Data Daftar Ulang</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->level == 'admin' || auth()->user()->level == 'petugas')
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/dashboard/potab') }}" aria-expanded="false"
                                    data-toggle="collapse" data-target="#DataPembayaranDropdown"
                                    aria-controls="DataPembayaranDropdown">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                    <span class="hide-menu">Data Pembayaran</span>
                                    <i class="mdi mdi-chevron-down float-right"></i>
                                </a>
                                <ul id="DataPembayaranDropdown" class="collapse first-level" aria-expanded="false">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('dashboard/pembayaran') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-multiple"></i>
                                            <span class="hide-menu">Pembayaran SPP</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/pembayaran-bekal') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-multiple"></i>
                                            <span class="hide-menu">Pembayaran Bekal</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/pembayaran-potab') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-multiple"></i>
                                            <span class="hide-menu">Pembayaran Potab</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/pembayaran-outbond') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-multiple"></i>
                                            <span class="hide-menu">Pembayaran Outbond</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/pembayaran-drumband') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-multiple"></i>
                                            <span class="hide-menu">Pembayaran Drumband</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/pembayaran-kegiatan') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-multiple"></i>
                                            <span class="hide-menu">Pembayaran Kegiatan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                            href="{{ url('/dashboard/pembayaran-ijazah') }}" aria-expanded="false">
                                            <i class="mdi mdi-cash-multiple"></i>
                                            <span class="hide-menu">Pembayaran Ijazah</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-liauth()->user()->level == 'admin'nk waves-effect waves-dark sidebar-link"
                                    href="{{ url('/dashboard/tabungan-siswa') }}" aria-expanded="false">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span class="hide-menu">Tabungan Siswa</span>
                                </a>
                            </li>

                            {{-- <li class="sidebar-item">
                                <a class="sidebar-liauth()->user()->level == 'admin'nk waves-effect waves-dark sidebar-link"
                                    href="{{ url('dashboard/pembayaran') }}" aria-expanded="false">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span class="hide-menu">Pembayaran SPP</span>
                                </a>
                            </li> --}}

                            {{-- <li class="sidebar-item">
                                <a class="sidebar-liauth()->user()->level == 'admin'nk waves-effect waves-dark sidebar-link"
                                    href="{{ url('/dashboard/pembayaran-bekal') }}" aria-expanded="false">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span class="hide-menu">Pembayaran Bekal</span>
                                </a>
                            </li> --}}

                            {{-- <li class="sidebar-item">
                                <a class="sidebar-liauth()->user()->level == 'admin'nk waves-effect waves-dark sidebar-link"
                                    href="{{ url('/dashboard/pembayaran-potab') }}" aria-expanded="false">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span class="hide-menu">Pembayaran Potab</span>
                                </a> --}}
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('dashboard/histori') }}" aria-expanded="false">
                                <i class="mdi mdi-history"></i>
                                <span class="hide-menu">History Pembayaran</span>
                            </a>
                        </li>
                        @if (auth()->user()->level == 'admin')
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('dashboard/laporan') }}" aria-expanded="false">
                                    <i class="mdi mdi-file"></i>
                                    <span class="hide-menu">Generate Laporan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/dashboard/foto-profil') }}" aria-expanded="false">
                                    <i class="mdi mdi-account-box-outline"></i>
                                    <span class="hide-menu">Foto Profil</span>
                                </a>
                            </li>
                        @endif
                    </ul>

                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    @yield('breadcrumb')
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @yield('content')

            </div>
            <footer class="footer text-center">
                TK Dharma Wanita
            </footer>
        </div>
    </div>
    <script>
        @yield('sweet')

        @yield('js')
    </script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.js') }}"></script>
</body>

</html>
