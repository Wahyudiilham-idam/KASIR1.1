<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id'");
header("Location: index.php");
?>
Sampai tahap ini, modul CRUD produk sud