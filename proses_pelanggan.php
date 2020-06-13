<?php
include "koneksi.php";
$kode = $_POST['kode_pelanggan'];
$nama = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat_pelanggan'];
$hp = $_POST['no_hp'];
$jenis = $_POST['jenis_pelanggan'];
$tgl = $_POST['tanggal_aktif'];
if (isset($_POST['simpan'])) {
    $sql = "INSERT INTO pelanggan VALUES('$kode','$nama','$alamat','$hp','$jenis','$tgl')";
    $run = mysqli_query($con, $sql);
    if ($run) {
        header('location:pelanggan.php');
    } else {
        echo mysqli_error($con);
    }
} else if (isset($_POST['ubah'])) {
    $sql = "UPDATE  pelanggan set nama_pelanggan='$nama',alamat_pelanggan='$alamat',
    no_hp='$hp',jenis_pelanggan='$jenis',tanggal_aktif='$tgl' WHERE kode_pelanggan = '$kode'";
    $run = mysqli_query($con, $sql);
    if ($run) {
        header('location:pelanggan.php');
    } else {
        echo mysqli_error($con);
    }
} else if (isset($_POST['hapus'])) {
    $sql = "DELETE FROM pelanggan WHERE kode_pelanggan = '$kode'";
    $run = mysqli_query($con, $sql);
    if ($run) {
        header('location:pelanggan.php');
    } else {
        echo mysqli_error($con);
    }
}