<!-- content.php -->
<?php
include "../config/koneksi.php";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    // Parameter Buku
    switch ($page) {
        case "buku":
            include "pages/buku/view.php";
            break;

            case "addbuku":
                include "pages/buku/create.php";
                break;

        case "editbuku":
            include "pages/buku/edit.php";
            break;
    }
    // Parameter Kostomer
    switch ($page) {
        case "anggota":
            include "pages/anggota/view.php";
            break;

            case "addanggota":
                include "pages/anggota/create.php";
                break;

        case "editanggota":
            include "pages/anggota/edit.php";
            break;
    }
    // Paramete Kategori
    switch ($page) {
        case "kategori";
            include "pages/kategori/view.php";
            break;

            case "addkategori";
            include "pages/kategori/create.php";
            break;

            case "editkategori";
            include "pages/kategori/edit.php";
            break;
    }
    // Parameter Sales
    switch ($page) {
        case "peminjaman":
            include "pages/peminjaman/view.php";
            break;

            case "addpeminjaman":
                include "pages/peminjaman/create.php";
                break;

                case "detailpeminjaman":
                    include "pages/peminjaman/detail.php";
                    break;
    }
} else {
    include "pages/home.php";
}