<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Peminjaman Buku</h4>
    </div>
    <a href="dashboard.php?page=addpeminjaman" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>No Peminjaman</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Kembali</th>
                            <th>Nama Peminjam</th>
                            <th class="text-center">Jumlah Buku</th>
                            <th class="text-center" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        //    Query Join
                        $sql = "SELECT 
                                    peminjaman.*, 
                                    anggota.nama as anggota_name,
                                    SUM(detail_peminjaman.jumlah) as total_pinjam
                                FROM peminjaman 
                                LEFT JOIN anggota ON peminjaman.anggota_id = anggota.id 
                                LEFT JOIN detail_peminjaman ON peminjaman.id = detail_peminjaman.peminjaman_id
                                GROUP BY peminjaman.id
                                ORDER BY peminjaman.id DESC";

                        $query = mysqli_query($koneksi, $sql);

                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><strong><?php echo $data['no_pinjam']; ?></strong></td>
                                <td><?php echo $data['tanggal_pinjam']; ?></td>
                                <td><?php echo $data['tanggal_kembali']; ?></td>
                                <td>
                                    <?php echo $data['anggota_name'] ? $data['anggota_name'] : '<span class="text-muted italic">Umum/Guest</span>'; ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">
                                        <?php echo ($data['total_pinjam'] > 0) ? $data['total_pinjam'] : '0'; ?> Buku
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">

                                        <a href="dashboard.php?page=detailpeminjaman&id=<?= $data['id']; ?>"
                                            class="btn btn-sm btn-info text-white"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        <?php if ($data['status'] == 'dipinjam'): ?>
                                            <a href="pages/peminjaman/action.php?act=return&id=<?= $data['id']; ?>"
                                                class="btn btn-sm btn-success"
                                                onclick="return confirm('Konfirmasi: Apakah buku benar-benar sudah dikembalikan?')">
                                                <i class="bi bi-arrow-return-left"></i> Kembalikan
                                            </a>
                                        <?php else: ?>
                                            <span class="badge badge-secondary p-2">
                                                <i class="fas fa-check-circle"></i> Selesai
                                            </span>
                                        <?php endif; ?>

                                    </div>
                                </td>

                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>