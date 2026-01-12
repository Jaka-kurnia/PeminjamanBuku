<?php
// Bagian Generate Invoice & Data Master tetap sama
$today = date("Ymd");
$query = "SELECT no_pinjam FROM peminjaman WHERE no_pinjam LIKE 'PJM/$today%' ORDER BY id DESC LIMIT 1";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);

if ($data) {
    $last_inv = $data['no_pinjam'];
    $number = (int) substr($last_inv, -2);
    $number++;
} else {
    $number = 1;
}
$new_invoice = "PJM/" . $today . "/" . sprintf("%02s", $number);

$q_anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
$q_buku = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<div class="container-fluid mt-4">
    <form action="pages/peminjaman/action.php?act=insert" method="POST">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Informasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>No. Peminjaman</label>
                            <input type="text" class="form-control" name="no_pinjam" value="<?= $new_invoice; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tanggal_pinjam" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Kembali</label>
                            <input type="date" class="form-control" name="tanggal_kembali" value="<?= date('Y-m-d', strtotime('+7 days')); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Anggota</label>
                            <select class="form-control" name="anggota_id" required>
                                <option value="">-- Pilih Anggota --</option>
                                <?php while ($a = mysqli_fetch_array($q_anggota)) { ?>
                                    <option value="<?= $a['id']; ?>"><?= $a['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select class="form-control" name="status" required>
                                <option value="dipinjam">Dipinjam</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="kembali">Dikembalikan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h6 class="mb-0">Daftar Buku</h6>

                            <button type="button" class="btn btn-light btn-sm" onclick="addRow()">
                                <i class="fas fa-plus"></i> Tambah Buku
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered" id="itemTable">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <th width="120px">Jumlah</th>
                                    <th width="50px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="item-row">
                                    <td>
                                        <select class="form-control" name="buku_id[]" required>
                                            <option value="">-- Pilih Buku --</option>
                                            <?php
                                            mysqli_data_seek($q_buku, 0);
                                            while ($b = mysqli_fetch_assoc($q_buku)) { ?>
                                                <option value="<?= $b['buku_id']; ?>"><?= $b['judul']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="jumlah[]" value="1" min="1">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-row" onclick="removeRow(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success w-100 mt-3">Simpan Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function addRow() {
        let table = document.getElementById('itemTable').getElementsByTagName('tbody')[0];
        let row = document.querySelector('.item-row').cloneNode(true);
        row.querySelector('select').selectedIndex = 0;
        row.querySelector('input').value = 1;
        table.appendChild(row);
    }

    function removeRow(btn) {
        let table = document.getElementById('itemTable').getElementsByTagName('tbody')[0];
        if (table.rows.length > 1) {
            btn.closest('tr').remove();
        }
    }
</script>