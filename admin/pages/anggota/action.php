<?php
// action

// Menginclude file koneksi database
include "../../../config/koneksi.php";
// Memulai session untuk bisa menggunakan $_SESSION (untuk notifikasi)
session_start();

// Mengecek apakah ada parameter 'act' di URL (insert, update, atau delete)
if (isset($_GET['act'])) {
    $act = $_GET['act']; // Menyimpan jenis aksi ke variabel $act

    // === LOGIKA INSERT (TAMBAH DATA) ===
    if ($act == "insert") {
        // Mengambil data dari form (POST)
        $kode_anggota = $_POST['kode_anggota'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        // $created_at = $_POST['created_at'];

        // Query SQL untuk menyimpan data baru ke tabel categories
        // ID tidak perlu dimasukkan karena AUTO_INCREMENT
        $query = "INSERT INTO anggota (kode_anggota, nama, jenis_kelamin, alamat, no_hp) 
        VALUES ('$kode_anggota', '$nama', '$jenis_kelamin', '$alamat', '$no_hp')";
        $execute = mysqli_query($koneksi, $query); // Eksekusi query

        // Pengecekan apakah query berhasil
        if ($execute) {
            // Jika berhasil, set pesan notifikasi Sukses
            $_SESSION['message'] = 'Data Berhasil Disimpan';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'Success';
            mysqli_close($koneksi); // Menutup koneksi database
            // Redirect kembali ke halaman list kategori
            header('location:../../dashboard.php?page=anggota');
            exit;
        } else {
            // Jika gagal, set pesan notifikasi Gagal
            $_SESSION['message'] = 'Data Gagal Disimpan';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'Failed';
            mysqli_close($koneksi);
            header('location:../../dashboard.php?page=anggota');
            exit;
            mysqli_close($koneksi);
        }

        // === LOGIKA UPDATE (EDIT DATA) ===
    }elseif ($act == "update") {
        // Mengambil data dari form (POST)
        $id = $_POST['id'];
        $kode_anggota = $_POST['kode_anggota'];
        $nama = $_POST['nama'];
         $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        // Query SQL untuk memperbarui data
        $query = "UPDATE anggota SET 
            kode_anggota = '$kode_anggota',
            nama = '$nama',
            jenis_kelamin = '$jenis_kelamin',
            alamat = '$alamat',
            no_hp = '$no_hp'
            WHERE id = '$id' ";
        $execute = mysqli_query($koneksi, $query);
        // Pengecekan apakah query berhasil
        if ($execute) {
            $_SESSION['message'] = 'Data Berhasil Di Update';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'Success';
            mysqli_close($koneksi);
            header('location:../../dashboard.php?page=anggota');
            exit;
        } else {
            $_SESSION['message'] = 'Data Gagal Di Update';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'Failed';
            mysqli_close($koneksi);
            header('location:../../dashboard.php?page=anggota');
            exit;
        }
        mysqli_close($koneksi);
    }elseif ($act == "delete") {
        // Mengambil id_buku yang akan dihapus dari parameter URL
        $id = $_GET['id'];

        // Query SQL untuk menghapus data
        $sql = "DELETE FROM anggota WHERE id='$id'";
        $execute = mysqli_query($koneksi, $sql);

        if ($execute) {
            $_SESSION['message'] = 'Data Berhasil Di Hapus';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'Success';
            mysqli_close($koneksi);
            header('location:../../dashboard.php?page=anggota');
            exit;
        } else {
            $_SESSION['message'] = 'Data Gagal Di Hapus';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'Failed';
            mysqli_close($koneksi);
            header('location:../../dashboard.php?page=anggota');
            exit;
        }
    }
}
