<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>Sistem Informasi Manajemen Aset</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="/asset/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="/">
               <span class="align-middle">Simaset</span>
                </a>

                <ul class="sidebar-nav">
                @if (in_array(auth()->user()->roles, ['admin', 'unit', 'yayasan']))
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/home">
                                <i class="bi bi-speedometer2"></i> <span class="align-middle">Dashboard</span>
                            </a>
                        </li>
                
                        @endif        
                        @if (auth()->user()->roles === 'admin')
                        <li class="sidebar-header">
                            Data User
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/datauser/">
                                <i class="bi bi-people"></i> <span class="align-middle">Data User</span>
                            </a>
                        </li>
                   @endif
                   <li class="sidebar-header">
                            Data Pengadaan
                        </li>
                   @if (auth()->user()->roles === 'unit')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/pengadaan/">
                                <i class="bi bi-box"></i> <span class="align-middle">Pengajuan</span>
                            </a>
                        </li>
                        @elseif (auth()->user()->roles === 'yayasan')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/permintaan/">
                                <i class="bi bi-box"></i> <span class="align-middle">Review Permintaan</span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->roles === 'admin')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/pengadaan-disetujui">
                                <i class="bi bi-check-circle"></i> <span class="align-middle">Permintaan Disetujui</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->roles === 'admin')
                    <li class="sidebar-header">
                        Data Master Aset
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/barang/">
                            <i class="bi bi-collection"></i> <span class="align-middle">Data Barang</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->roles === 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/kategori/">
                            <i class="bi bi-tags"></i> <span class="align-middle">Kategori</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/subkategori/">
                            <i class="bi bi-diagram-3"></i> <span class="align-middle">Subkategori</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/subdivisi/">
                            <i class="bi bi-diagram-3"></i> <span class="align-middle">Subdivisi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/satuan/">
                            <i class="bi bi-hdd-stack"></i><span class="align-middle">Unit</span>
                        </a>
                    </li>
@endif
                    @if (auth()->user()->roles === 'admin')
                        <li class="sidebar-header">
                            Laporan
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/statistik/">
                                <i class="bi bi-clipboard-data"></i> <span class="align-middle">Statistik</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/keuangan/">
                                <i class="bi bi-currency-dollar"></i> <span class="align-middle">Keuangan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/laporan/">
                                <i class="bi bi-journals"></i> <span class="align-middle">Cetak Laporan</span>
                            </a>
                        </li>
                      
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/label/">
                                <i class="bi bi-qr-code"></i> <span class="align-middle">Cetak Label</span>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->roles === 'admin')
                        <li class="sidebar-header">
                            Data Master Lokasi
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/gedung/">
                                <i class="bi bi-geo-alt"></i> <span class="align-middle">Gedung</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/lantai/">
                                <i class="bi bi-geo-alt"></i> <span class="align-middle">Lantai</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/ruangan/">
                                <i class="bi bi-geo-alt"></i> <span class="align-middle">Ruangan</span>
                            </a>
                        </li>

                        <li class="sidebar-header">
                            Riwayat
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/penghapusan-aset/">
                                <i class="bi bi-clock-history"></i> <span class="align-middle">Penghapusan Aset</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                          <a class="sidebar-link" href="/pemindahan">
                          <i class="bi bi-arrow-repeat"></i> <span class="align-middle">Pemindahan Aset</span>
                          </a>
                         </li>
                        <li class="sidebar-header">
                            Pengaturan
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/reset-password/">
                                <i class="bi bi-unlock"></i> <span class="align-middle">Reset Password</span>
                            </a>
                        </li>
                    @endif
                    </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="/asset/img/avatars/avatar.png" class="avatar img-fluid rounded me-1" /> <span class="text-dark">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/reset-password/"><i class="align-middle me-1" data-feather="settings"></i> Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     Swal.fire({
                                                        title: 'Konfirmasi Keluar',
                                                        text: 'Apakah Anda yakin ingin keluar?',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#abcdef',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Ya, Keluar!'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById('logout-form').submit();
                                                        }
                                                    });">
                                        {{ __('Keluar') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    @yield('content')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">

                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="/asset/js/app.js"></script>

    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#text' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <script>
        $(".swal-confirm").click(function(e) {
            e.preventDefault();
            var form = $(this).attr('data-form');
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data yang dihapus akan masuk ke riwayat penghapusan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + form).submit();
                }
            })
        });
    </script>

    <script>
        $(".pengajuan-confirm").click(function(e) {
            e.preventDefault();
            var form = $(this).attr('data-form');
            Swal.fire({
                title: 'Konfirmasi Persetujuan',
                text: "Apakah Anda Yakin Ingin Menyetujui?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Setujui !',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + form).submit();
                }
            })
        });
    </script>

    <script>
        $(".tolak-confirm").click(function(e) {
            e.preventDefault();
            var form = $(this).attr('data-form');
            Swal.fire({
                title: 'Konfirmasi Penolakan',
                text: "Apakah Anda Yakin Ingin Menolak Permintaan Barang Ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Tolak !',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + form).submit();
                }
            })
        });
    </script>

    <script>
        var navItems = document.querySelectorAll('.sidebar-item');
        for (var i = 0; i < navItems.length; i++) {
            navItems[i].addEventListener('click', function() {
                for (var j = 0; j < navItems.length; j++) {
                    navItems[j].classList.remove('active');
                }
                this.classList.add('active');
                localStorage.setItem('selectedNav', this.querySelector('a').getAttribute('href'));
            });
        }
        var selectedNav = localStorage.getItem('selectedNav');
        if (selectedNav) {
            for (var i = 0; i < navItems.length; i++) {
                var navLink = navItems[i].querySelector('a');
                if (navLink.getAttribute('href') === selectedNav) {
                    navItems[i].classList.add('active');
                    break;
                }
            }
        }
    </script>

</body>

</html>