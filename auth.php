<!-- auth.php -->
<?php
session_start();

include "config/koneksi.php";
$email = $_POST['email'];
$password = $_POST['password'];

// Query Bedasarkan email dan password
$sql = "SELECT * FROM users WHERE email ='$email' AND password = '$password'";
// Eksekusi query
$query = mysqli_query($koneksi, $sql);
// Cek User
$cekuser = mysqli_num_rows($query);


// Logic user login
if ($cekuser == 0) {
    header("location:index.php");
    $_SESSION['message'] = 'Username or Password Wrong';
    mysqli_close($koneksi);
} else {
    $datauser = mysqli_fetch_array($query);
    $_SESSION['status_login'] = true;
    $_SESSION['name'] = $datauser['name'];
    $_SESSION['email'] = $datauser['email'];
    $_SESSION['role'] = $datauser['role'];
    header("location:admin/dashboard.php");
    mysqli_close($koneksi);
}