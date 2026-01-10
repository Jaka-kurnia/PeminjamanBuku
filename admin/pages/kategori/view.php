<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kategori</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex mb-3 justify-content-between">
                    <a href="dashboard.php?page=addkategori" class="btn btn-primary ">Tambah Data</a>
                    <a href="pages/products/print.php" class="btn btn-success" target="_blank">Cetak</a>
                </div>
                <?php

                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert <?php echo $_SESSION['alert_type']; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5>
                            <?php
                            if ($_SESSION['type'] == 'Success') {
                            ?>
                                <i class="icon fas fa-check"></i>
                            <?php
                            } else {
                            ?>
                                <i class="icon fas fa-ban"></i>
                            <?php } ?>
                            <?php echo $_SESSION['type'] ?>
                        </h5>
                        <!-- Pesan Error-->
                        <?php echo $_SESSION['message']; ?>
                    </div>
                <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['alert_type']);
                    unset($_SESSION['type']);
                }
                ?>
                <!-- Form FIlter-->
                <form method="GET" action="">
                    <input type="hidden" name="page" value="kategori">
                    <div class="row">
                        <div class="col-10">
                            <input class="form-control mb-2" type="text" name="nama_kategori"
                                placeholder="Kategori" value="<?php if (isset($_GET['nama_kategori'])) {
                                                                        echo $_GET['nama_kategori'];
                                                                    } ?>">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>

                </form>
                <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class=" text-center">
            <tr>
                <th style="width: 50px;">No</th>
                <th>Kategori</th>
                <th style="width: 160px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql = "SELECT * FROM kategori";
            $query = mysqli_query($koneksi, $sql);
            while ($kategori = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $kategori['nama_kategori']; ?></td>
                    <td class="text-center">
                        <a href="dashboard.php?page=editkategori&id=<?= $kategori['id']; ?>"
                            class="btn btn-sm btn-warning text-white mr-1">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="pages/kategori/action.php?act=delete&id=<?= $kategori['id']; ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure to delete this data?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

            </div>
            <!-- /.card-body -->

        </div>
    </div><!-- /.container-fluid -->
</div>