<?php
include "../../../config/koneksi.php";
session_start();

if (isset($_GET['act']) && $_GET['act'] == "insert") {

    mysqli_begin_transaction($koneksi);

    try {
        $no_pinjam        = mysqli_real_escape_string($koneksi, $_POST['no_pinjam']);
        $anggota_id       = mysqli_real_escape_string($koneksi, $_POST['anggota_id']);
        $tanggal_pinjam   = $_POST['tanggal_pinjam'];
        $tanggal_kembali  = $_POST['tanggal_kembali'];
        $status           = $_POST['status'];
        $user_id          = $_SESSION['user_id'] ?? 1;

        // Tambaha Peminjaman
        $sql = "INSERT INTO peminjaman 
                (no_pinjam, anggota_id, user_id, tanggal_pinjam, tanggal_kembali, status)
                VALUES 
                ('$no_pinjam', '$anggota_id', '$user_id', '$tanggal_pinjam', '$tanggal_kembali', '$status')";

        if (!mysqli_query($koneksi, $sql)) {
            throw new Exception("Gagal simpan peminjaman");
        }

        $peminjaman_id = mysqli_insert_id($koneksi);

    // Proses detail peminjaman
        $buku_id_array = $_POST['buku_id'] ?? [];
        $jumlah_array  = $_POST['jumlah'] ?? [];

        for ($i = 0; $i < count($buku_id_array); $i++) {

            $buku_id = mysqli_real_escape_string($koneksi, $buku_id_array[$i]);
            $jumlah  = (int) $jumlah_array[$i];

            if ($buku_id == '' || $jumlah <= 0) {
                continue;
            }

            // Cek stok buku
            $cek = mysqli_query($koneksi, 
                "SELECT stok FROM buku WHERE buku_id='$buku_id' FOR UPDATE"
            );

            $data = mysqli_fetch_assoc($cek);

            if ($data['stok'] < $jumlah) {
                throw new Exception("Stok buku tidak mencukupi");
            }

            // Tambah Detail Peminjaman
            $sql_detail = "INSERT INTO detail_peminjaman 
                           (peminjaman_id, buku_id, jumlah)
                           VALUES 
                           ('$peminjaman_id', '$buku_id', '$jumlah')";

            if (!mysqli_query($koneksi, $sql_detail)) {
                throw new Exception("Gagal simpan detail peminjaman");
            }

        
            $update_stok = "UPDATE buku 
                            SET stok = stok - $jumlah 
                            WHERE buku_id = '$buku_id'";

            if (!mysqli_query($koneksi, $update_stok)) {
                throw new Exception("Gagal update stok buku");
            }
        }

        mysqli_commit($koneksi);

        $_SESSION['message'] = 'Transaksi berhasil & stok otomatis berkurang';
        $_SESSION['alert_type'] = 'alert-success';
        $_SESSION['type'] = 'Success';
        header('location:../../dashboard.php?page=peminjaman');
        exit;

    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        $_SESSION['message'] = 'Transaksi gagal: ' . $e->getMessage();
        $_SESSION['alert_type'] = 'alert-danger';
        $_SESSION['type'] = 'Failed';
        header('location:../../dashboard.php?page=addpeminjaman');
        exit;
    }
}

// --- LOGIKA PENGEMBALIAN BUKU (LOGIKA BARU) ---
elseif (isset($_GET['act']) && $_GET['act'] == "return") {
    
    // Ambil ID dari URL (id primary key pada tabel peminjaman)
    $id_peminjaman = mysqli_real_escape_string($koneksi, $_GET['id']);

    mysqli_begin_transaction($koneksi);

    try {
        // 1. Pastikan data peminjaman ada dan statusnya masih 'dipinjam'
        $cek_peminjaman = mysqli_query($koneksi, "SELECT status FROM peminjaman WHERE id = '$id_peminjaman' FOR UPDATE");
        $data_peminjaman = mysqli_fetch_assoc($cek_peminjaman);

        if (!$data_peminjaman) {
            throw new Exception("Data peminjaman tidak ditemukan.");
        }

        if ($data_peminjaman['status'] == 'tersedia') {
            throw new Exception("Buku sudah pernah dikembalikan sebelumnya.");
        }

        // 2. Ambil semua buku yang dipinjam dalam transaksi ini dari tabel detail_peminjaman
        $query_detail = mysqli_query($koneksi, "SELECT buku_id, jumlah FROM detail_peminjaman WHERE peminjaman_id = '$id_peminjaman'");

        while ($row = mysqli_fetch_assoc($query_detail)) {
            $buku_id = $row['buku_id'];
            $jumlah  = $row['jumlah'];

            // 3. Update stok buku (TAMBAH kembali stoknya)
            $update_stok = "UPDATE buku SET stok = stok + $jumlah WHERE buku_id = '$buku_id'";
            if (!mysqli_query($koneksi, $update_stok)) {
                throw new Exception("Gagal mengembalikan stok buku.");
            }
        }

        // 4. Update status di tabel peminjaman menjadi 'tersedia'
        $sql_update_status = "UPDATE peminjaman SET status = 'tersedia' WHERE id = '$id_peminjaman'";
        if (!mysqli_query($koneksi, $sql_update_status)) {
            throw new Exception("Gagal update status peminjaman.");
        }

        // Jika semua oke, simpan perubahan
        mysqli_commit($koneksi);

        $_SESSION['message'] = 'Buku berhasil dikembalikan dan stok telah diperbarui';
        $_SESSION['alert_type'] = 'alert-success';
        $_SESSION['type'] = 'Success';
        header('location:../../dashboard.php?page=peminjaman');
        exit;

    } catch (Exception $e) {
        // Jika ada error, batalkan semua perubahan stok
        mysqli_rollback($koneksi);

        $_SESSION['message'] = 'Gagal Pengembalian: ' . $e->getMessage();
        $_SESSION['alert_type'] = 'alert-danger';
        $_SESSION['type'] = 'Failed';
        header('location:../../dashboard.php?page=peminjaman');
        exit;
    }
}
?>