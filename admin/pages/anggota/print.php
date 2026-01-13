<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>

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
$query = "SELECT * FROM anggota ORDER BY nama ASC";
$execute = mysqli_query($koneksi, $query);
?>

<body class="A5 landscape">

<section class="sheet padding-10mm">

    <div class="container-fluid">

        <h4 class="text-center mb-4 fw-bold">List Anggota</h4>

        <table class="table table-bordered table-striped table-sm">
            <thead class="table-primary text-center text-white">
                <tr>
                    <th width="5%">No</th>
                    <th>Kode Anggota</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($execute)) {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo $data['kode_anggota']; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['jenis_kelamin']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['no_hp']; ?></td>

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
