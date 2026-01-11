<?php

// Ambil ID dari URL dan amankan dari SQL Injection
$peminjaman_id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

// 1. Ambil Header Transaksi (Tabel peminjaman & anggota)
// peminjaman.id terhubung dengan anggota.id melalui peminjaman.anggota_id
$sql_header = "SELECT peminjaman.*, anggota.nama AS anggota_name 
               FROM peminjaman 
               LEFT JOIN anggota ON peminjaman.anggota_id = anggota.id 
               WHERE peminjaman.id = '$peminjaman_id'";

$query_header = mysqli_query($koneksi, $sql_header);
$header = mysqli_fetch_array($query_header);

// 2. Ambil Detail Items (Tabel detail_peminjaman & buku)
// detail_peminjaman.buku_id terhubung dengan buku.buku_id
$sql_detail = "SELECT detail_peminjaman.*, buku.judul AS judul_buku, buku.kode_buku 
               FROM detail_peminjaman 
               LEFT JOIN buku ON detail_peminjaman.buku_id = buku.buku_id 
               WHERE detail_peminjaman.peminjaman_id = '$peminjaman_id'";

$query_detail = mysqli_query($koneksi, $sql_detail);

// Validasi jika data tidak ditemukan untuk mencegah error "null array"
if (!$header) {
    echo "<div class='alert alert-danger'>Data peminjaman tidak ditemukan!</div>";
    exit;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Peminjaman Buku</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detail Pinjam</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">No. Pinjam #<?php echo htmlspecialchars($header['no_pinjam']); ?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                    <a href="dashboard.php?page=peminjaman" class="btn btn-tool">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <strong>Nama Anggota:</strong><br>
                        <?php echo htmlspecialchars($header['anggota_name']); ?><br><br>
                        <strong>Tanggal Pinjam:</strong><br>
                        <?php echo date('d-m-Y', strtotime($header['tanggal_pinjam'])); ?>
                    </div>
                    <div class="col-sm-6 text-right">
                        <strong>Status:</strong><br>
                        <span class="badge <?php echo ($header['status'] == 'dipinjam') ? 'badge-warning' : 'badge-success'; ?>">
                            <?php echo strtoupper($header['status']); ?>
                        </span><br><br>
                        <strong>Tanggal Kembali:</strong><br>
                        <?php echo date('d-m-Y', strtotime($header['tanggal_kembali'])); ?>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="50px">No</th>
                                    <th>Kode Buku</th>
                                    <th>Judul Buku</th>
                                    <th width="100px" class="text-center">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                while($data = mysqli_fetch_array($query_detail)) { 
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($data['kode_buku']); ?></td>
                                    <td><?php echo htmlspecialchars($data['judul_buku']); ?></td>
                                    <td class="text-center"><?php echo $data['jumlah']; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if (mysqli_num_rows($query_detail) == 0) : ?>
                                    <tr><td colspan="4" class="text-center">Tidak ada item buku.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>