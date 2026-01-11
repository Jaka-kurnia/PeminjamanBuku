<?php
// Mengambil category_id dari parameter URL
// Contoh: dashboard.php?page=editcategory&category_id=1
$id = $_GET['id'];

// Query untuk mengambil data  berdasarkan ID untuk ditampilkan di form
$sql = "SELECT * FROM kategori WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query); // Mengambil data sebagai array
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <!-- Breadcrumb -->
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Kategori</li>
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
                <h3 class="card-title">Edit Kategori</h3>
            </div>
            <div class="card-body">
                <!-- Form untuk update data -->
                <!-- action mengirim ke action.php dengan act=update dan membawa category_id yang sedang diedit -->
                <form action="pages/kategori/action.php?act=update&id=<?php echo $id; ?>" method="POST">
                    
                    <div class="form-group">
                        <label>Category Name</label>
                        <!-- Menampilkan value lama dari database ke dalam input -->
                        <input type="text" class="form-control" name="nama_kategori" value="<?php echo $data['nama_kategori']; ?>" required>
                    </div>
                    
                    <!-- Tombol Simpan Perubahan -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
