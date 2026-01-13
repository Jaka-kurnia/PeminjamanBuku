<div class="content-header">
    <div class="container-fluid">
        <h1>Data Buku</h1>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex mb-2 justify-content-between">
                    <a href="dashboard.php?page=addbuku" class="btn btn-primary mb-3">
                        Tambah Data
                    </a>
                    <!-- <a href="pages/products/print.php" class="btn btn-success" target="_blank">Cetak</a> -->
                </div>
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert <?= $_SESSION['alert_type']; ?>">
                        <strong><?= $_SESSION['type']; ?></strong><br>
                        <?= $_SESSION['message']; ?>
                    </div>
                <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['alert_type']);
                    unset($_SESSION['type']);
                } ?>

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


                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = "SELECT buku.*, kategori.nama_kategori
                                FROM buku
                                INNER JOIN kategori
                                ON buku.kategori_id = kategori.id";

                            $q = mysqli_query($koneksi, $sql);
                            while ($d = mysqli_fetch_assoc($q)) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $d['kode_buku'] ?></td>
                                    <td><?= $d['judul'] ?></td>
                                    <td><?= $d['pengarang'] ?></td>
                                    <td><?= $d['penerbit'] ?></td>
                                    <td><?= $d['tahun_terbit'] ?></td>
                                    <td><?= $d['nama_kategori'] ?></td>
                                    <td><?= $d['stok'] ?></td>
                                    <td>
                                        <a href="dashboard.php?page=editbuku&buku_id=<?= $d['buku_id'] ?>"
                                            class="btn btn-warning btn-sm text-white">
                                            Edit
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="pages/buku/action.php?act=delete&buku_id=<?= $d['buku_id'] ?>"
                                            onclick="return confirm('Yakin hapus data ini?')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</div>