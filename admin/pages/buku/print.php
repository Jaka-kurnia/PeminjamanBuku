<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Product</title>

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
$query = "SELECT * FROM customers";
$execute = mysqli_query($koneksi, $query);
?>

<body class="A5 landscape">

<section class="sheet padding-10mm">

    <div class="container-fluid">

        <h4 class="text-center mb-4 fw-bold">List Customers</h4>

        <table class="table table-bordered table-striped table-sm">
            <thead class="table-primary text-center text-white">
                <tr>
                    <th width="5%">No</th>
                    <th>Customer Code</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($customer = mysqli_fetch_array($execute)) {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo $customer['customer_code']; ?></td>
                        <td><?php echo $customer['customer_name']; ?></td>
                        <td><?php echo $customer['phone']; ?></td>
                        <td><?php echo $customer['customer_address']; ?></td>
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
