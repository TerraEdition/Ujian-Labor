<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="text-center">
            <h1>
                <a href="index.php">
                    Aplikasi Laundry Transformer
                </a>
            </h1>
            <h3>LAUNDRY TRANSFORMER</h3>
            <h3>LAPORAN TRANSAKSI PENCUCIAN</h3>
            <h4>Jln.Durian No 35 Pekanbaru Riau</h4>
        </div>
        <center>
            <table cellpadding="5" border="1">
                <tr>
                    <th>No</th>
                    <th>No Faktur Cucian</th>
                    <th>Tanggal Faktur</th>
                    <th>Nama Pelanggan</th>
                    <th>Jenis Pelanggan</th>
                    <th>Jenis Paket</th>
                    <th>Jumlah Kilo</th>
                    <th>Diskon</th>
                    <th>Total Harga</th>
                </tr>
                <?php
                $no = 1;
                $sql = "SELECT transaksi_pencucian.*,pelanggan.* FROM transaksi_pencucian, pelanggan WHERE transaksi_pencucian.kode_pelanggan=pelanggan.kode_pelanggan";
                $run = mysqli_query($con, $sql);
                while ($r = mysqli_fetch_row($run)) {
                    $total_diskon += $r[6];
                    $total_harga += $r[7];
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r[0] ?></td>
                    <td><?= $r[1] ?></td>
                    <td><?= $r[9] ?></td>
                    <td><?= $r[12] ?></td>
                    <td><?= $r[3] ?></td>
                    <td><?= $r[5] ?></td>
                    <td><?= $r[6] ?></td>
                    <td><?= $r[7] ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <th colspan="7">Total Diskon</th>
                    <th><?= $total_diskon ?></th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="8">Total Harga</th>
                    <th><?= $total_harga ?></th>
                </tr>
            </table>
        </center>
    </div>
</body>

</html>