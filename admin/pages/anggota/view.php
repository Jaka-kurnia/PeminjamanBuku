<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Anggota</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Anggota</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex mb-3 justify-content-between">
                    <a href="dashboard.php?page=addanggota" class="btn btn-primary ">Tambah Data</a>
                    <a href="pages/products/print.php" class="btn btn-success" target="_blank">Cetak</a>
                </div>
                <?php

                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert <?php echo $_SESSION['alert_type']; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5>
                            <?php
                            if ($_SESSION['type'] == 'Success') {
                            ?>
                                <i class="icon fas fa-check"></i>
                            <?php
                            } else {
                            ?>
                                <i class="icon fas fa-ban"></i>
                            <?php } ?>
                            <?php echo $_SESSION['type'] ?>
                        </h5>
                        <!-- Pesan Error-->
                        <?php echo $_SESSION['message']; ?>
                    </div>
                <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['alert_type']);
                    unset($_SESSION['type']);
                }
                ?>
                <!-- Form FIlter-->
                <form method="GET" action="">
                    <input type="hidden" name="page" value="buku">
                    <div class="row">
                        <div class="col-10">
                            <input class="form-control mb-2" type="text" name="judul"
                                placeholder="Judul Buku" value="<?php if (isset($_GET['judul'])) {
                                                                    echo $_GET['judul'];
                                                                } ?>">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>


                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped align-middle">
                        <thead class=" text-center">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 120 explain;">Kode Anggota</th>
                                <th>Nama</th>
                                <th style="width: 140px;">Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th style="width: 130px;">No HP</th>
                                <th style="width: 160px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = "SELECT * FROM anggota";
                            $query = mysqli_query($koneksi, $sql);
                            while ($anggota = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $anggota['kode_anggota']; ?></td>
                                    <td><?= $anggota['nama']; ?></td>
                                    <td class="text-center"><?= $anggota['jenis_kelamin']; ?></td>
                                    <td><?= $anggota['alamat']; ?></td>
                                    <td class="text-center"><?= $anggota['no_hp']; ?></td>
                                    <td class="text-center">
                                        <a href="dashboard.php?page=editanggota&id=<?= $anggota['id']; ?>"
                                            class="btn btn-sm btn-warning text-white mb-1">
                                            Edit
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="pages/anggota/action.php?act=delete&id=<?= $anggota['id']; ?>"
                                            class="btn btn-sm btn-danger mb-1"
                                            onclick="return confirm('Are you sure to delete this data?')">
                                            Hapus
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.card-body -->

        </div>
    </div><!-- /.container-fluid -->
</div>