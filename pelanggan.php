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
            $sql = "SELECT * FROM pelanggan WHERE kode_pelanggan = '$_GET[id]'";
            $run = mysqli_query($con, $sql);
            $r = mysqli_fetch_row($run);
        }
        ?>
        <form action="proses_pelanggan.php" method="POST">
            <table>
                <tr>
                    <td>Kode Pelanggan</td>
                    <td>:</td>
                    <td><input type="text" name="kode_pelanggan" maxlength="10" value="<?= @$r[0] ?>"
                            <?= @$r[0] != '' ? 'readonly' : '' ?>></td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>:</td>
                    <td><input type="text" name="nama_pelanggan" maxlength="20" value="<?= @$r[1] ?>"></td>
                </tr>
                <tr>
                    <td>Alamat Pelanggan</td>
                    <td>:</td>
                    <td><input type="text" name="alamat_pelanggan" maxlength="50" value="<?= @$r[2] ?>"></td>
                </tr>
                <tr>
                    <td>Nomor HP</td>
                    <td>:</td>
                    <td><input type="text" name="no_hp" maxlength="20" value="<?= @$r[3] ?>"></td>
                </tr>
                <tr>
                    <td>Jenis Pelanggan</td>
                    <td>:</td>
                    <td>
                        <select name="jenis_pelanggan">
                            <option value="General" <?= @$r[4] == 'General' ? 'selected' : '' ?>>General</option>
                            <option value="Platinum" <?= @$r[4] == 'Platinum' ? 'selected' : '' ?>>Platinum</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Aktif</td>
                    <td>:</td>
                    <td><input type="date" name="tanggal_aktif" value="<?= @$r[5] == '' ? date('Y-m-d') : @$r[5] ?>">
                    </td>
                </tr>
            </table>
            <?php
            if (@$_GET['stat'] == 'ubah') { ?>
            <button type="submit" name="ubah">Simpan</button>
            <button type="submit" name="hapus">Hapus</button>
            <?php } else { ?>
            <button type="submit" name="simpan">Simpan</button>
            <?php } ?>
            <a href="pelanggan.php"><button type="button">Reset</button></a>
        </form>

        <h1>Data Pelanggan</h1>
        <table cellpadding="5" border="1">
            <tr>
                <th>Kode Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat Pelanggan</th>
                <th>Nomor HP</th>
                <th>Jenis Pelanggan</th>
                <th>Tanggal Aktif</th>
                <th>Opsi</th>
            </tr>
            <?php
            $sql = "SELECT * FROM pelanggan";
            $run = mysqli_query($con, $sql);
            while ($r = mysqli_fetch_row($run)) {
            ?>
            <tr>
                <td><?= $r[0] ?></td>
                <td><?= $r[1] ?></td>
                <td><?= $r[2] ?></td>
                <td><?= $r[3] ?></td>
                <td><?= $r[4] ?></td>
                <td><?= $r[5] ?></td>
                <th> <a href="pelanggan.php?id=<?= $r[0] ?>&stat=ubah">Edit</a>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>