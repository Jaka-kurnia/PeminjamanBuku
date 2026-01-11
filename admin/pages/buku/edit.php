<?php
$buku_id = $_GET['buku_id'];
$q = mysqli_query($koneksi, "SELECT * FROM buku WHERE buku_id='$buku_id'");
$data = mysqli_fetch_assoc($q);
?>

<div class="content-header">
    <div class="container-fluid">
        <h1>Edit Buku</h1>
    </div>
</div>

<div class="content">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="pages/buku/action.php?act=update&buku_id=<?= $buku_id ?>" method="POST">

                    <input class="form-control mb-2" name="kode_buku" value="<?= $data['kode_buku'] ?>" required>
                    <input class="form-control mb-2" name="judul" value="<?= $data['judul'] ?>" required>
                    <input class="form-control mb-2" name="pengarang" value="<?= $data['pengarang'] ?>" required>
                    <input class="form-control mb-2" name="penerbit" value="<?= $data['penerbit'] ?>" required>
                    <input class="form-control mb-2" name="tahun_terbit" value="<?= $data['tahun_terbit'] ?>" required>

                    <select name="kategori_id" class="form-control mb-2" required>
                        <option value="">Pilih Kategori</option>
                        <?php
                        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($k = mysqli_fetch_assoc($kat)) {
                            $sel = ($k['id'] == $data['kategori_id']) ? "selected" : "";
                            echo "<option value='$k[id]' $sel>$k[nama_kategori]</option>";
                        }
                        ?>
                    </select>

                    <input class="form-control mb-3" name="stok" value="<?= $data['stok'] ?>" required>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="dashboard.php?page=buku" class="btn btn-danger">Kembali</a>
                </form>

            </div>
        </div>
    </div>
</div>
