<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Riwayat Transaksi</h3>
        <a href="kasir.php" class="btn btn-success">+ Transaksi Baru</a>
    </div>
    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $q = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
        while ($t = mysqli_fetch_assoc($q)) {
        ?>
            <tr>
                <td><?= $t['kode_transaksi'] ?></td>
                <td><?= $t['tanggal'] ?></td>
                <td>Rp <?= number_format($t['total_bayar'], 0, ',', '.') ?></td>
                <td><a href="struk.php?id=<?= $t['id_transaksi'] ?>" class="btn btn-sm btn-dark">Lihat Struk</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>