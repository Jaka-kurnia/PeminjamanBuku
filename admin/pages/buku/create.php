<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Product</h1>
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
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Buku</h3>
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
                <form method="POST" action="pages/buku/action.php?act=insert">
                    <input class="form-control mb-2" type="text" name="kode_buku"
                        placeholder="Kode Buku" required>
                    <input class="form-control mb-2" type="text" name="judul"
                        placeholder="Judul Buku" required>
                    <input class="form-control mb-2" type="text" name="pengarang"
                        placeholder="Pengarang" required>
                    <input class="form-control mb-2" type="text" name="penerbit"
                        placeholder="Penerbit" required>
                    <input class="form-control mb-2" type="text" name="tahun_terbit"
                        placeholder="Tahun Terbit" required>
                        
                    <select class="form-control mb-2" name="kategori_id" required>
                        <option value="">Choose Category</option>

                        <?php
                        $sql = "SELECT * FROM kategori";
                        $query = mysqli_query($koneksi, $sql);
                        while ($kategori = mysqli_fetch_assoc($query)) {
                        ?>
                            <option value="<?= $kategori['id']; ?>">
                                <?= $kategori['nama_kategori']; ?>
                            </option>
                        <?php } ?>
                    </select>

                    <input class="form-control mb-2" type="text" name="stok"
                        placeholder="Stock" required>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                    <button type="reset" class="btn btn-danger">
                        Reset
                    </button>
                </form>

            </div>
            <!-- /.card-body -->

        </div>
    </div><!-- /.container-fluid -->
</div>