<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="">SI Keterlambatan Siswa </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <li><a class="dropdown-item" href="<?= base_url('Auth/logout'); ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Admin Area</div>
                        <?php
                        if ($title == 'Dashboard') {
                            //arahih ke controller admin
                            echo '<a class="nav-link active" href="' . base_url('Admin') . '">';
                        } else {
                            echo '<a class="nav-link" href="' . base_url('Admin') . '">';
                        }
                        ?>
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Siswa</div>

                        <?php
                        if ($title == 'Data Siswa') {
                            //arahih ke controller admin
                            echo '<a class="nav-link active" href="' . base_url('Admin/siswa') . '">';
                        } else {
                            echo '<a class="nav-link" href="' . base_url('Admin/siswa') . '">';
                        }
                        ?>
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Siswa
                        </a>
                        <div class="sb-sidenav-menu-heading">Laporan Keterlambatan</div>

                        <?php
                        if ($title == 'Mencatat Keterlambatan') {
                            //arahih ke controller admin
                            echo '<a class="nav-link active" href="' . base_url('Admin/terlambat') . '">';
                        } else {
                            echo '<a class="nav-link" href="' . base_url('Admin/terlambat') . '">';
                        }
                        ?> <div class="sb-nav-link-icon"><i class="fas fa-pencil-alt"></i></div>
                        Mencatat Keterlambatan
                        </a>
                        <?php
                        if ($title == 'Cetak Laporan') {
                            //arahih ke controller admin
                            echo '<a class="nav-link active" href="' . base_url('Admin/laporan') . '">';
                        } else {
                            echo '<a class="nav-link" href="' . base_url('Admin/laporan') . '">';
                        }
                        ?> <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                        Cetak Laporan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $this->session->userdata('nama'); ?>
                </div>
            </nav>
        </div>