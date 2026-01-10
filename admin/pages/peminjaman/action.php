<?php
include "../../../config/koneksi.php";
session_start();

if (isset($_GET['act'])) {
    $act = $_GET['act'];

    if ($act == "insert") {
        // Mengamankan input string
        $no_pinjam = mysqli_real_escape_string($koneksi, $_POST['no_pinjam']);
        $anggota_id = mysqli_real_escape_string($koneksi, $_POST['anggota_id']);
        $tanggal_pinjam = $_POST['tanggal_pinjam'];
        $tanggal_kembali = $_POST['tanggal_kembali'];
        $status = $_POST['status'];
        $user_id = $_SESSION['user_id'] ?? 1;

        // 1. Insert ke tabel peminjaman
        $sql = "INSERT INTO peminjaman (no_pinjam, anggota_id, user_id, tanggal_pinjam, tanggal_kembali, status) 
                VALUES ('$no_pinjam', '$anggota_id', '$user_id', '$tanggal_pinjam', '$tanggal_kembali', '$status')";

        if (mysqli_query($koneksi, $sql)) {
            $peminjaman_id = mysqli_insert_id($koneksi);

            // 2. Ambil data array dari form
            $buku_id_array = $_POST['buku_id'] ?? []; 
            $jumlah_array = $_POST['jumlah'] ?? []; // Pastikan ini 'jumlah', bukan 'qty'

            for ($i = 0; $i < count($buku_id_array); $i++) {
                $id_buku = mysqli_real_escape_string($koneksi, $buku_id_array[$i]);
                $jml = mysqli_real_escape_string($koneksi, $jumlah_array[$i] ?? 0);

                if (!empty($id_buku)) {
                    // PERBAIKAN: Nama tabel sesuai database adalah peminjaman_detail
                    $sql_detail = "INSERT INTO detail_peminjaman (peminjaman_id, buku_id, jumlah) 
                                   VALUES ('$peminjaman_id', '$id_buku', '$jml')";

                    mysqli_query($koneksi, $sql_detail);
                }
            }

            $_SESSION['message'] = 'Transaksi Berhasil Disimpan';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'Success';
            header('location:../../dashboard.php?page=peminjaman');
            exit;
        } else {
            $_SESSION['message'] = 'Transaksi Gagal: ' . mysqli_error($koneksi);
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'Failed';
            header('location:../../dashboard.php?page=addpeminjaman');
            exit;
        }
    }
}