<?php
include 'koneksi.php';
$id = $_GET['id'];

$trx = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id'"));
$detail = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$id'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Struk Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 480px;">
    <div class="bg-white p-3 rounded shadow-sm" style="font-family: monospace">
        <h5 class="text-center">TOKO SEDERHANA</h5>
        <p class="text-center mb-1"><?= $trx['kode_transaksi'] ?></p>
        <p class="text-center"><?= $trx['tanggal'] ?></p>
        <hr>
        <?php while ($d = mysqli_fetch_assoc($detail)) { ?>
        <div class="d-flex justify-content-between">
            <span><?= htmlspecialchars($d['nama_produk']) ?> x<?= $d['jumlah'] ?></span>
            <span>Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></span>
        </div>
        <?php } ?>
        <hr>
        <div class="d-flex justify-content-between fw-bold">
            <span>Total</span><span>Rp <?= number_format($trx['total_bayar'], 0, ',', '.') ?></span>
        </div>
        <div class="d-flex justify-content-between">
            <span>Bayar</span><span>Rp <?= number_format($trx['uang_diberikan'], 0, ',', '.') ?></span>
        </div>
        <div class="d-flex justify-content-between">
            <span>Kembali</span><span>Rp <?= number_format($trx['kembalian'], 0, ',', '.') ?></span>
        </div>
        <p class="text-center mt-3">Terima kasih!</p>
    </div>
    <div class="text-center mt-3">
        <button onclick="window.print()" class="btn btn-dark">Cetak</button>
        <a href="kasir.php" class="btn btn-outline-secondary">Transaksi Baru</a>
        <a href="logout.php" class="btn btn-danger">logout</a>
    </div>
</div>
</body>
</html>