<?php
include "koneksi.php";
$no = $_POST['no_faktur'];
$tgl = $_POST['tanggal_faktur'];
$kode = $_POST['kode_pelanggan'];
$jenis = $_POST['jenis_paket'];
$jumlah = $_POST['jumlah_kilo'];
switch ($jenis) {
    case 'Cucian + Setrika':
        $harga = '10000';
        break;
    case 'Cucian Saja':
        $harga = '6000';
        break;
    case 'Setrika Saja':
        $harga = '4000';
        break;
}
$pelanggan = mysqli_fetch_row(mysqli_query($con, "SELECT jenis_pelanggan FROM pelanggan WHERE kode_pelanggan='$kode'"))[0];
if ($pelanggan == 'Platinum' && $jumlah > 3) {
    $diskon = ($harga * $jumlah) * 5 / 100;
} else {
    $diskon = 0;
}
$total = $harga * $jumlah - $diskon;
if (isset($_POST['simpan'])) {
    $sql = "INSERT INTO transaksi_pencucian VALUES('$no','$tgl','$kode','$jenis','$harga','$jumlah','$diskon','$total')";
    $run = mysqli_query($con, $sql);
    if ($run) {
        header('location:transaksi.php');
    } else {
        echo mysqli_error($con);
    }
} else if (isset($_POST['ubah'])) {
    $sql = "UPDATE transaksi_pencucian set tanggal_faktur='$tgl',kode_pelanggan='$kode',
    jenis_paket='$jenis',harga='$harga',jumlah_kilo='$jumlah',diskon='$diskon',total_harga='$total' WHERE no_faktur = '$no'";
    $run = mysqli_query($con, $sql);
    if ($run) {
        header('location:transaksi.php');
    } else {
        echo mysqli_error($con);
    }
} else if (isset($_POST['hapus'])) {
    $sql = "DELETE FROM transaksi_pencucian WHERE no_faktur = '$no'";
    $run = mysqli_query($con, $sql);
    if ($run) {
        header('location:transaksi.php');
    } else {
        echo mysqli_error($con);
    }
}