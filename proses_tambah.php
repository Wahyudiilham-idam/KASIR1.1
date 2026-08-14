<?php
include 'koneksi.php';

$nama      = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$kategori  = mysqli_real_escape_string($koneksi, $_POST['kategori']);
$harga     = (int) $_POST['harga'];
$stok      = (int) $_POST['stok'];

$query = "INSERT INTO produk (nama_produk, kategori, harga, stok)
          VALUES ('$nama', '$kategori', '$harga', '$stok')";

if (mysqli_query($koneksi, $query)) {
    header("Location: index.php");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>