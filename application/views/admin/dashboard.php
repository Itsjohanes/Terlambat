<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard Admin</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Total Admin</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php echo $jumlahAdmin; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Total Siswa</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php echo $jumlahSiswa; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Total Keterlambatan Hari ini</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php echo $jumlahTerlambat; ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Siswa yang Terlambat Tanggal <?php echo $tanggal; ?>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kelas</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kelas</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>

                            <?php foreach ($terlambat as $j) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $j['nama_siswa']; ?></td>
                                    <td><?= $j['kelas_siswa']; ?></td>
                                </tr>
                                <?php $i++; ?>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>