<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

    <!-- Paper CSS -->
    <link rel="stylesheet" href="../../../assets/paper/paper.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            body {
                background: none;
            }
            table {
                font-size: 11px;
            }
        }
    </style>
</head>

<?php
include '../../../config/koneksi.php';
$query = "SELECT * FROM buku INNER JOIN kategori on buku.kategori_id=kategori.id  ORDER BY buku_id ASC";
$execute = mysqli_query($koneksi, $query);
?>

<body class="A5 landscape">

<section class="sheet padding-10mm">

    <div class="container-fluid">

        <h4 class="text-center mb-4 fw-bold">List Buku</h4>

        <table class="table table-bordered table-striped table-sm">
            <thead class="table-primary text-center text-white">
                <tr>
                    <th width="5%">No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($execute)) {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo $data['kode_buku']; ?></td>
                        <td><?php echo $data['judul']; ?></td>
                        <td><?php echo $data['pengarang']; ?></td>
                        <td><?php echo $data['penerbit']; ?></td>
                        <td><?php echo $data['tahun_terbit']; ?></td>
                        <td><?php echo $data['nama_kategori']; ?></td>
                        <td><?php echo $data['stok']; ?></td>

                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>

    </div>
</section>

</body>
</html>
