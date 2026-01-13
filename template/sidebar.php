<?php
// Mengambil parameter page dari URL untuk menentukan menu mana yang aktif
$current_page = isset($_GET['page']) ? $_GET['page'] : '';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
     <a href="index3.html" class="brand-link">
         <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">PEMINJAMAN || BUKU</span>
     </a>

     <div class="sidebar">
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="../assets/dist/img/avatar4.png" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">
                     <?php echo $_SESSION['nama']; ?>
                     <br>
                     <small><?php echo $_SESSION['email']; ?></small>
                 </a>
             </div>
         </div>

         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 
                 <li class="nav-item">
                     <a href="dashboard.php?page=main" class="nav-link <?php echo ($current_page == 'main') ? 'active' : ''; ?>">
                         <i class="bi bi-house-fill text-lg"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>

                 <li class="nav-item <?php echo in_array($current_page, ['buku', 'anggota', 'kategori']) ? 'menu-open' : ''; ?>">
                     <a href="#" class="nav-link <?php echo in_array($current_page, ['buku', 'anggota', 'kategori']) ? 'active' : ''; ?>">
                         <i class="bi bi-database text-lg"></i>
                         <p>
                             Master Data
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="dashboard.php?page=buku" class="nav-link <?php echo ($current_page == 'buku') ? 'active' : ''; ?>">
                                 <i class="bi bi-book text-lg"></i>
                                 <p>Buku</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="dashboard.php?page=anggota" class="nav-link <?php echo ($current_page == 'anggota') ? 'active' : ''; ?>">
                                 <i class="bi bi-people-fill text-lg"></i>
                                 <p>Anggota </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="dashboard.php?page=kategori" class="nav-link <?php echo ($current_page == 'kategori') ? 'active' : ''; ?>">
                                 <i class="bi bi-list text-lg"></i>
                                 <p>Kategori</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-item <?php echo ($current_page == 'peminjaman') ? 'menu-open' : ''; ?>">
                     <a href="#" class="nav-link <?php echo ($current_page == 'peminjaman') ? 'active' : ''; ?>">
                         <i class="bi bi-database text-lg"></i>
                         <p>
                             Data Transaction
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="dashboard.php?page=peminjaman" class="nav-link <?php echo ($current_page == 'peminjaman') ? 'active' : ''; ?>">
                                 <i class="bi bi-receipt-cutoff text-lg"></i>
                                 <p>Peminjaman</p>
                             </a>
                         </li>
                         <!-- <li class="nav-item">
                             <a href="dashboard.php?page=pengembalian" class="nav-link <?php echo ($current_page == 'pengembalian') ? 'active' : ''; ?>">
                                 <i class="bi bi-receipt-cutoff text-lg"></i>
                                 <p>Pengembalian</p>
                             </a>
                         </li> -->
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="../logout.php" class="nav-link">
                         <i class="bi bi-box-arrow-left"></i>
                         <p>Logout</p>
                     </a>
                 </li>
             </ul>
         </nav>
     </div>
 </aside>
