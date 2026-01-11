<?php
include "../../../config/koneksi.php";
session_start();

if (!isset($_GET['act'])) {
    header("location:../../dashboard.php?page=buku");
    exit;
}

$act = $_GET['act'];

// Logika Insert
if ($act == "insert") {

    $kode_buku    = $_POST['kode_buku'];
    $judul        = $_POST['judul'];
    $pengarang    = $_POST['pengarang'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $kategori_id  = $_POST['kategori_id'];
    $stok         = $_POST['stok'];

    $sql = "INSERT INTO buku 
            (kode_buku, judul, pengarang, penerbit, tahun_terbit, kategori_id, stok)
            VALUES
            ('$kode_buku','$judul','$pengarang','$penerbit','$tahun_terbit','$kategori_id','$stok')";

    if (mysqli_query($koneksi, $sql)) {
        $_SESSION['message'] = "Data berhasil disimpan";
        $_SESSION['alert_type'] = "alert-success";
        $_SESSION['type'] = "Success";
    } else {
        $_SESSION['message'] = "Data gagal disimpan";
        $_SESSION['alert_type'] = "alert-danger";
        $_SESSION['type'] = "Failed";
    }

    header("location:../../dashboard.php?page=buku");
    exit;
}

// Logika Update
elseif ($act == "update") {

    $buku_id      = $_GET['buku_id'];
    $kode_buku    = $_POST['kode_buku'];
    $judul        = $_POST['judul'];
    $pengarang    = $_POST['pengarang'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $kategori_id  = $_POST['kategori_id'];
    $stok         = $_POST['stok'];

    // validasi kode buku
    $cek = mysqli_query($koneksi,
        "SELECT * FROM buku 
         WHERE kode_buku='$kode_buku' 
         AND buku_id!='$buku_id'"
    );

    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['message'] = "Kode buku sudah digunakan";
        $_SESSION['alert_type'] = "alert-danger";
        $_SESSION['type'] = "Failed";
        header("location:../../dashboard.php?page=buku");
        exit;
    }

    $sql = "UPDATE buku SET
            kode_buku='$kode_buku',
            judul='$judul',
            pengarang='$pengarang',
            penerbit='$penerbit',
            tahun_terbit='$tahun_terbit',
            kategori_id='$kategori_id',
            stok='$stok'
            WHERE buku_id='$buku_id'";

    if (mysqli_query($koneksi, $sql)) {
        $_SESSION['message'] = "Data berhasil diupdate";
        $_SESSION['alert_type'] = "alert-success";
        $_SESSION['type'] = "Success";
    } else {
        $_SESSION['message'] = "Data gagal diupdate";
        $_SESSION['alert_type'] = "alert-danger";
        $_SESSION['type'] = "Failed";
    }

    header("location:../../dashboard.php?page=buku");
    exit;
}

// logika Delete
elseif ($act == "delete") {

    $buku_id = $_GET['buku_id'];

    if (mysqli_query($koneksi, "DELETE FROM buku WHERE buku_id='$buku_id'")) {
        $_SESSION['message'] = "Data berhasil dihapus";
        $_SESSION['alert_type'] = "alert-success";
        $_SESSION['type'] = "Success";
    } else {
        $_SESSION['message'] = "Data gagal dihapus";
        $_SESSION['alert_type'] = "alert-danger";
        $_SESSION['type'] = "Failed";
    }

    header("location:../../dashboard.php?page=buku");
    exit;
}
