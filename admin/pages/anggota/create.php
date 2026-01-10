<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Anggota</h1>
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
                <h3 class="card-title">Add Anggota</h3>
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
                <form method="POST" action="pages/anggota/action.php?act=insert">
                    <input class="form-control mb-2" type="text" name="kode_anggota"
                        placeholder="Kode Anggota" required>

                    <input class="form-control mb-2" type="text" name="nama"
                        placeholder="Nama Anggota" required>

                    <select name="jenis_kelamin" class="form-control mb-2" required>
                        <option value="">Choose Jenis Kelamin</option>

                        <option value="L" <?php echo (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>
                            Laki-laki (L)
                        </option>

                        <option value="P" <?php echo (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>
                            Perempuan (P)
                        </option>
                    </select>


                    <!-- <input class="form-control mb-2" type="text" name="jenis_kelamin"
                        placeholder="Pengarang" required> -->

                    <input class="form-control mb-2" type="text" name="alamat"
                        placeholder="Alamat" required>

                    <input class="form-control mb-2" type="text" name="no_hp"
                        placeholder="Nomor Handpone" required>

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