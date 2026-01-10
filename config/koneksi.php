<?php
$koneksi = mysqli_connect("localhost","root","","dbuas");

if(!$koneksi){
    mysqli_connect_errno();
    die;
}

?>