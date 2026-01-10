<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Anggota</h1>
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
                <h3 class="card-title">Edit Data Anggota</h3>
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
                <?php
                // Mengambil id_buku dari parameter URL
                $id = $_GET['id'];

                // Query SQL untuk mengambil data buku berdasarkan id
                $query = "SELECT * FROM anggota WHERE id = '$id'";
                $execute = mysqli_query($koneksi, $query);
                $anggota = mysqli_fetch_array($execute);
                ?>
                <input type="hidden" name="id" value="<?= $anggota['id']; ?>">
                <form method="POST" action="pages/anggota/action.php?act=update&id=<?php echo $id; ?>">
                    <input class="form-control mb-2" type="text" name="kode_anggota"
                        placeholder="Kode Anggota" value="<?php echo $anggota['kode_anggota'] ?>"
                        required>

                    <input class="form-control mb-2" type="text" name="nama"
                        placeholder="Nama" value="<?php echo $anggota['nama']; ?>" required>

                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" <?= (isset($anggota['jenis_kelamin']) && $anggota['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>
                            Laki-laki
                        </option>
                        <option value="P" <?= (isset($anggota['jenis_kelamin']) && $anggota['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>
                            Perempuan
                        </option>
                    </select>



                    <input class="form-control mb-2" type="text" name="alamat"
                        placeholder="Alamat" value="<?php echo $anggota['alamat']; ?>" required>

                    <input class="form-control mb-2" type="text" name="no_hp"
                        placeholder="No HP" value="<?php echo $anggota['no_hp']; ?>" required>



                    <?php

                    ?>
                    <button type="submit" class="btn btn-success">
                        Update
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