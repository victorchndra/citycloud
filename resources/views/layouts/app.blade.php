<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CityCloud</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller d-flex">


        <!-- partial:./partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            @if (Auth::user()->roles == 'god' || Auth::user()->roles == 'admin')
                <ul class="nav">

                    <li class="nav-item sidebar-category">
                        <p>Dashboard</p>
                        <span></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                            <div class="badge badge-info badge-pill">2</div>
                        </a>
                    </li>

                    <li class="nav-item sidebar-category">
                        <p>Menu Utama</p>
                        <span></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#citizensmenu">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            <span class="menu-title">Kependudukan</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="citizensmenu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/citizens">Penduduk Aktif</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/family">Kartu Keluarga</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="/dtks">Penduduk DTKS</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="/move">Penduduk Pindah</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="/death">Penduduk
                                        Meninggal</a></li>
                            </ul>
                        </div>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#letter">
                            <i class="mdi mdi mdi-email menu-icon"></i>
                            <span class="menu-title">Surat</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="letter">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/letters">Surat Keluar</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="/letters-citizens">Surat Warga</a>
                                </li>
                            </ul>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link" href="/log">
                            <i class="mdi mdi-history menu-icon"></i>
                            <span class="menu-title">Aktivitas</span>
                        </a>
                    </li>

                    <li class="nav-item sidebar-category">
                        <p>Posyandu</p>
                        <span></span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/health-care">
                            <i class="mdi mdi-history menu-icon"></i>
                            <span class="menu-title">Data Anak</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/motherkb">
                            <i class="mdi mdi-chart-pie menu-icon"></i>
                            <span class="menu-title">Data Ibu KB</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/motherpregnant">
                            <i class="mdi mdi-chart-pie menu-icon"></i>
                            <span class="menu-title">Data Ibu Hamil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/wuspus">
                            <i class="mdi mdi-chart-pie menu-icon"></i>
                            <span class="menu-title">Data WUS/PUS</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kidsweight">
                            <i class="mdi mdi-chart-pie menu-icon"></i>
                            <span class="menu-title">Data Timbang Anak</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kidsweightmonth">
                            <i class="mdi mdi-chart-pie menu-icon"></i>
                            <span class="menu-title">Data Timbang Anak Bulan</span>
                        </a>
                    </li>

                    <li class="nav-item sidebar-category">
                        <p>Pengaturan</p>
                        <span></span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="mdi mdi-settings menu-icon"></i>
                            <span class="menu-title">Master Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/rt"> Data RT </a></li>
                                <li class="nav-item"> <a class="nav-link" href="/rw"> Data RW </a></li>
                                <li class="nav-item"> <a class="nav-link" href="/assistance"> Data Bantuan
                                        Sosial </a></li>
                                <li class="nav-item"> <a class="nav-link" href="/users"> Data Pengguna </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="/information"> Data
                                        Informasi </a></li>
                                <li class="nav-item"> <a class="nav-link" href="/agerange"> Rentang Usia
                                    </a></li>
                                <li class="nav-item"> <a class="nav-link" href="/kb"> Jenis KB </a></li>
                                <li class="nav-item"> <a class="nav-link" href="/ims"> Jenis Imunisasi </a>
                                </li>
                            </ul>
                        </div>
                    </li>
            @endif

            @if (Auth::user()->roles == 'citizens' || Auth::user()->roles == 'ketua rt')
                <ul class="nav">

                    <li class="nav-item sidebar-category">
                        <p>Dashboard</p>
                        <span></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                            <div class="badge badge-info badge-pill">2</div>
                        </a>
                    </li>

                    <li class="nav-item sidebar-category">
                        <p>Menu Utama</p>
                        <span></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#letters" aria-expanded="false"
                            aria-controls="letters">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            <span class="menu-title">Surat</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="letters">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/letters">Buat Surat</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="/letters-citizens">Surat
                                        Warga</a></li>
                            </ul>
                        </div>

                    </li>
            @endif

            @guest
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/logout"
                        onclick="if(confirm('Keluar dari sistem?')){ event.preventDefault(); document.getElementById('logout-form').submit(); }else{ return false; }">
                        <button class="btn bg-danger btn-lg menu-title"><i class="mdi mdi-arrow-left-bold-circle"></i>
                            Logout</button>
                    </a>

                    </a>
                </li>

                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>
                @endif


                </ul>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:./partials/_navbar.html -->
                <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>
                        <div class="navbar-brand-wrapper">
                            <a class="navbar-brand brand-logo" href="/"><img src="/images/logo.svg" alt="logo" /></a>
                            <a class="navbar-brand brand-logo-mini" href="/"><img src="/images/logo-mini.svg"
                                    alt="logo" /></a>
                        </div>
                        <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Selamat Datang,
                            {{ ucwords(Auth::user()->name) }}</h4>
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown me-2">
                                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                                    id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-bell mx-0"></i>
                                    <span class="count bg-danger">1</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                    aria-labelledby="notificationDropdown">
                                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                    {{-- <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-information mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Just now
                    </p>
                  </div>
                </a> --}}
                                    {{-- @foreach ($datas as $data)

                <a class="dropdown-item preview-item" href="/log">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                    </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">Victor baru saja menambah pengguna baru</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                            {{ $data->created_at->diffForHumans() }}
                        </p>
                    </div>
                </a>
                @endforeach --}}
                                    {{-- <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-account-box mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      2 days ago
                    </p>
                  </div>
                </a> --}}
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                            data-toggle="offcanvas">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                    <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
                        <ul class="navbar-nav mr-lg-2">
                            <li class="nav-item nav-search d-none d-lg-block">

                                <form action="" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            placeholder="Ketik kata kunci pencarian..." aria-label="search"
                                            aria-describedby="search" name="search" id="search"
                                            value="{{ request()->search }}">
                                    </div>
                                </form>


                            </li>
                        </ul>
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    id="profileDropdown">
                                    <i class="mdi mdi-account text-primary"></i>
                                    <span class="nav-profile-name">{{ ucwords(Auth::user()->name) }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="profileDropdown">
                                    <a href="/profiles" class="dropdown-item">
                                        <i class="mdi mdi-face text-primary"></i>
                                        Profil
                                    </a>
                                    @guest
                                    @else
                                        <a class="dropdown-item" href="/logout"
                                            onclick="if(confirm('Keluar dari sistem?')){ event.preventDefault(); document.getElementById('logout-form').submit(); }else{ return false; }">
                                            <i class="mdi mdi-logout text-primary"></i>
                                            Logout
                                        </a>
                                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        @endif
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>
                    <!-- partial -->
                    <div class="main-panel">
                        <div class="content-wrapper">
                            @yield('content')
                        </div>
                        <!-- content-wrapper ends -->
                        <!-- partial:./partials/_footer.html -->
                        <footer class="footer">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ??
                                            <a href="#" target="_blank">Kampung Digital Lembah Sari </a>2022</span>

                                    </div>
                                </div>
                            </div>
                        </footer>
                        <!-- partial -->
                    </div>
                    <!-- main-panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <!-- container-scroller -->

            <!-- base:js -->
            <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
            <!-- endinject -->
            <!-- Plugin js for this page-->
            <script src="{{ asset('/vendors/chart.js/Chart.min.js') }}"></script>
            {{-- My Custom Javascript --}}
            <script src="{{ asset('/js/script.js') }}" type="text/javascript"></script>
            {{-- End Custom Javascript --}}
            <script src="{{ asset('/js/jquery.cookie.js') }}" type="text/javascript"></script>
            <!-- End plugin js for this page-->
            <!-- inject:js -->
            <script src="{{ asset('/js/off-canvas.js') }}"></script>
            <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
            <script src="{{ asset('/js/template.js') }}"></script>
            <!-- endinject -->
            <!-- plugin js for this page -->
            <script src="{{ asset('/js/jquery.cookie.js') }}" type="text/javascript"></script>
            <!-- End plugin js for this page -->
            <!-- Custom js for this page-->

            <!-- End custom js for this page-->
        </body>


        </html>
