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

        // 1️⃣ Insert tabel peminjaman
        $sql = "INSERT INTO peminjaman 
                (no_pinjam, anggota_id, user_id, tanggal_pinjam, tanggal_kembali, status)
                VALUES 
                ('$no_pinjam', '$anggota_id', '$user_id', '$tanggal_pinjam', '$tanggal_kembali', '$status')";

        if (!mysqli_query($koneksi, $sql)) {
            throw new Exception("Gagal simpan peminjaman");
        }

        $peminjaman_id = mysqli_insert_id($koneksi);

        // 2️⃣ Ambil detail buku
        $buku_id_array = $_POST['buku_id'] ?? [];
        $jumlah_array  = $_POST['jumlah'] ?? [];

        for ($i = 0; $i < count($buku_id_array); $i++) {

            $buku_id = mysqli_real_escape_string($koneksi, $buku_id_array[$i]);
            $jumlah  = (int) $jumlah_array[$i];

            if ($buku_id == '' || $jumlah <= 0) {
                continue;
            }

            // 3️⃣ Cek stok buku
            $cek = mysqli_query($koneksi, 
                "SELECT stok FROM buku WHERE buku_id='$buku_id' FOR UPDATE"
            );

            $data = mysqli_fetch_assoc($cek);

            if ($data['stok'] < $jumlah) {
                throw new Exception("Stok buku tidak mencukupi");
            }

            // 4️⃣ Insert detail peminjaman
            $sql_detail = "INSERT INTO detail_peminjaman 
                           (peminjaman_id, buku_id, jumlah)
                           VALUES 
                           ('$peminjaman_id', '$buku_id', '$jumlah')";

            if (!mysqli_query($koneksi, $sql_detail)) {
                throw new Exception("Gagal simpan detail peminjaman");
            }

            // 5️⃣ Kurangi stok buku
            $update_stok = "UPDATE buku 
                            SET stok = stok - $jumlah 
                            WHERE buku_id = '$buku_id'";

            if (!mysqli_query($koneksi, $update_stok)) {
                throw new Exception("Gagal update stok buku");
            }
        }

        // 6️⃣ Commit jika semua sukses
        mysqli_commit($koneksi);

        $_SESSION['message'] = 'Transaksi berhasil & stok otomatis berkurang';
        $_SESSION['alert_type'] = 'alert-success';
        $_SESSION['type'] = 'Success';
        header('location:../../dashboard.php?page=peminjaman');
        exit;

    } catch (Exception $e) {

        // ❌ Jika gagal → rollback
        mysqli_rollback($koneksi);

        $_SESSION['message'] = 'Transaksi gagal: ' . $e->getMessage();
        $_SESSION['alert_type'] = 'alert-danger';
        $_SESSION['type'] = 'Failed';
        header('location:../../dashboard.php?page=addpeminjaman');
        exit;
    }
}
