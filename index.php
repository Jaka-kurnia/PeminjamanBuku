<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            scroll-behavior: smooth;
        }

        /* NAVBAR */
        .navbar {
            background-color: #0b3c6d;
            box-shadow: 0 4px 10px rgba(0,0,0,.15);
        }
        .navbar .nav-link {
            position: relative;
            margin-right: 12px;
        }
        .navbar .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #ffc107;
            transition: .3s;
        }
        .navbar .nav-link:hover::after {
            width: 100%;
        }

        /* HERO */
        .hero {
            background: linear-gradient(rgba(11,60,109,.9), rgba(11,60,109,.85)),
            url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f') center/cover;
            color: white;
            padding: 160px 0;
        }
        .hero h1 {
            font-size: 3rem;
        }
        .hero .btn {
            transition: .3s;
        }
        .hero .btn:hover {
            transform: translateY(-4px);
        }

        /* SECTION TITLE */
        .section-title {
            border-left: 5px solid #0b3c6d;
            padding-left: 15px;
            margin-bottom: 40px;
            font-weight: bold;
        }

        /* STATISTIK */
        .stat-box {
            background: white;
            border-radius: 14px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,.1);
            transition: .3s;
        }
        .stat-box:hover {
            transform: translateY(-8px);
        }
        .stat-box h2 {
            color: #0b3c6d;
            font-weight: bold;
        }

        /* CARD LAYANAN */
        .service-card {
            border: none;
            border-radius: 14px;
            transition: .3s;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,.15);
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: #e9f1fb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            margin-bottom: 20px;
        }

        /* FOOTER */
        footer {
            background-color: #0b3c6d;
            color: white;
        }
    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-book-reader"></i> PERPUSTAKAAN
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Koleksi</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                <li class="nav-item">
                    <a class="btn btn-warning btn-sm ms-2" href="login.php">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<section class="hero text-center">
    <div class="container">
        <h1 class="fw-bold">Sistem Peminjaman Buku Perpustakaan</h1>
        <p class="lead mt-3">
            Mendukung literasi melalui layanan peminjaman buku yang modern, tertib, dan terintegrasi.
        </p>
        <a href="#" class="btn btn-warning btn-lg mt-4">
            <i class="fas fa-book"></i> Lihat Koleksi Buku
        </a>
    </div>
</section>


<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stat-box">
                    <i class="fas fa-book fa-2x mb-2 text-primary"></i>
                    <h2>1.250+</h2>
                    <p>Koleksi Buku</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <i class="fas fa-users fa-2x mb-2 text-primary"></i>
                    <h2>540+</h2>
                    <p>Anggota</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <i class="fas fa-exchange-alt fa-2x mb-2 text-primary"></i>
                    <h2>3.200+</h2>
                    <p>Peminjaman</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <i class="fas fa-calendar-check fa-2x mb-2 text-primary"></i>
                    <h2>24/7</h2>
                    <p>Layanan</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-5">
    <div class="container">
        <h4 class="section-title">Layanan Perpustakaan</h4>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <div class="icon-circle">
                            <i class="fas fa-book fa-2x text-primary"></i>
                        </div>
                        <h5>Peminjaman Buku</h5>
                        <p>Peminjaman buku fisik dan digital dengan sistem terintegrasi.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <div class="icon-circle">
                            <i class="fas fa-search fa-2x text-primary"></i>
                        </div>
                        <h5>Pencarian Koleksi</h5>
                        <p>Pencarian buku berdasarkan judul, penulis, dan kategori.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <div class="icon-circle">
                            <i class="fas fa-user-check fa-2x text-primary"></i>
                        </div>
                        <h5>Keanggotaan</h5>
                        <p>Pendaftaran anggota untuk akses penuh layanan perpustakaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= INFORMASI ================= -->
<section class="bg-light py-5">
    <div class="container">
        <h4 class="section-title">Informasi Perpustakaan</h4>
        <div class="row align-items-center">
            <div class="col-md-6">
                <p>
                    Perpustakaan ini menyediakan sistem peminjaman buku yang terkomputerisasi
                    untuk mendukung kegiatan belajar dan meningkatkan minat baca masyarakat.
                </p>
                <ul>
                    <li>Koleksi buku lengkap</li>
                    <li>Sistem peminjaman terintegrasi</li>
                    <li>Laporan & monitoring</li>
                </ul>
            </div>
            <div class="col-md-6">
                <img src="assets/img/perpus.webp" alt="Perpustakaan"
                     class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="py-4">
    <div class="container text-center">
        <p class="fw-bold mb-1">Perpustakaan Digital</p>
        <p class="mb-0">© 2026 Sistem Peminjaman Buku | Untuk Pembelajaran</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
