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
        <h1 class="text-center">
            <a href="index.php">
                Aplikasi Laundry Transformer
            </a>
        </h1>
        <?php
        if ($_GET['stat'] == 'ubah' && $_GET['id'] != null) {
            $sql = "SELECT * FROM transaksi_pencucian WHERE no_faktur = '$_GET[id]'";
            $run = mysqli_query($con, $sql);
            $r = mysqli_fetch_row($run);
        }
        ?>
        <form action="proses_transaksi.php" method="POST">
            <table>
                <tr>
                    <td>No Faktur</td>
                    <td>:</td>
                    <td><input type="text" name="no_faktur" maxlength="10" value="<?= @$r[0] ?>"
                            <?= @$r[0] != '' ? 'readonly' : '' ?>></td>
                </tr>
                <tr>
                    <td>Tanggal Faktur</td>
                    <td>:</td>
                    <td><input type="date" name="tanggal_faktur" value="<?= @$r[1] == '' ? date('Y-m-d') : @$r[1] ?>">
                    </td>
                </tr>
                <tr>
                    <td>Kode Pelanggan</td>
                    <td>:</td>
                    <td>
                        <select name="kode_pelanggan">
                            <?php
                            $query = mysqli_query($con, "SELECT * FROM pelanggan");
                            while ($a = mysqli_fetch_row($query)) { ?>
                            <option value="<?= $a[0] ?>"><?= $a[1] ?></option>
                            <?php }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Paket</td>
                    <td>:</td>
                    <td>
                        <select name="jenis_paket">
                            <option value="Cucian + Setrika" <?= @$r[3] == 'Cucian + Setrika' ? 'selected' : '' ?>>
                                Cucian + Setrika</option>
                            <option value="Cuci Saja" <?= @$r[3] == 'Cuci Saja' ? 'selected' : '' ?>>
                                Cuci Saja</option>
                            <option value="Setrika Saja" <?= @$r[3] == 'Setrika Saja' ? 'selected' : '' ?>>
                                Setrika Saja</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah Kilo</td>
                    <td>:</td>
                    <td><input type="text" name="jumlah_kilo" maxlength="10" value="<?= @$r[5] ?>"></td>
                </tr>
            </table>
            <?php
            if (@$_GET['stat'] == 'ubah') { ?>
            <button type="submit" name="ubah">Simpan</button>
            <button type="submit" name="hapus">Hapus</button>
            <?php } else { ?>
            <button type="submit" name="simpan">Simpan</button>
            <?php } ?>

            <a href="transaksi.php"><button type="button">Reset</button></a>
        </form>

        <h1>Data Transaksi</h1>
        <table cellpadding="5" border="1">
            <tr>
                <th>No Faktur</th>
                <th>Tanggal Faktur</th>
                <th>Kode Pelanggan</th>
                <th>Jenis Paket</th>
                <th>Harga</th>
                <th>Jumlah Kilo</th>
                <th>Diskon</th>
                <th>Total Harga</th>
                <th>Opsi</th>
            </tr>
            <?php
            $sql = "SELECT transaksi_pencucian.*,pelanggan.nama_pelanggan FROM transaksi_pencucian, pelanggan WHERE transaksi_pencucian.kode_pelanggan=pelanggan.kode_pelanggan";
            $run = mysqli_query($con, $sql);
            while ($r = mysqli_fetch_row($run)) {
            ?>
            <tr>
                <td><?= $r[0] ?></td>
                <td><?= $r[1] ?></td>
                <td><?= $r[8] ?></td>
                <td><?= $r[3] ?></td>
                <td><?= $r[4] ?></td>
                <td><?= $r[5] ?></td>
                <td><?= $r[6] ?></td>
                <td><?= $r[7] ?></td>
                <th> <a href="transaksi.php?id=<?= $r[0] ?>&stat=ubah">Edit</a>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>