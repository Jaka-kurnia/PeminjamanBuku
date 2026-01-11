<?php

$query_buku = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku");
$row_buku = mysqli_fetch_assoc($query_buku);

$query_anggota = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM anggota");
$row_anggota = mysqli_fetch_assoc($query_anggota);

$query_kategori = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kategori");
$row_kategori = mysqli_fetch_assoc($query_kategori);

$query_pinjam = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM peminjaman");
$row_pinjam = mysqli_fetch_assoc($query_pinjam);

?>
<div class="content-header">

    <div class="container-fluid">

        <h1>Dashboard</h1>

    </div>

</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $row_buku['total']; ?></h3>
                        <p>Total Buku</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <a href="dashboard.php?page=buku" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $row_anggota['total']; ?></h3>
                        <p>Anggota Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <a href="dashboard.php?page=anggota" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner text-white">
                        <h3 class="text-white"><?php echo $row_kategori['total']; ?></h3>
                        <p>Kategori Buku</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-list-ul"></i>
                    </div>
                    <a href="dashboard.php?page=kategori" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $row_pinjam['total']; ?></h3>
                        <p>Peminjaman Baru</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <a href="dashboard.php?page=peminjaman" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>