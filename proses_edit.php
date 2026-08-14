<?php
include 'koneksi.php';

$id       = $_POST['id_produk'];
$nama     = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
$harga    = (int) $_POST['harga'];
$stok     = (int) $_POST['stok'];

$query = "UPDATE produk SET
          nama_produk = '$nama',
          kategori = '$kategori',
          harga = '$harga',
          stok = '$stok'
          WHERE id_produk = '$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: index.php");
} else {
    echo "Gagal mengubah data: " . mysqli_error($koneksi);
}
?>