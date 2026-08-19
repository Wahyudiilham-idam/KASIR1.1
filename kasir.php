<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Halaman Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Kasir - Transaksi Baru</h3>
        <div>
            <a href="riwayat.php" class="btn btn-outline-dark">Riwayat</a>
            <a href="index.php" class="btn btn-outline-secondary">Data Produk</a>
            <a href="logout.php" class="btn btn-danger">logout></a>
   </div>
    </div>

    <form action="simpan_transaksi.php" method="POST">
        <div class="row">

            <div class="col-md-8">
                <table class="table table-bordered bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Jumlah Beli</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $q = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok > 0");
                    while ($p = mysqli_fetch_assoc($q)) {
                    ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($p['nama_produk']) ?>
                                <input type="hidden" name="id_produk[]" value="<?= $p['id_produk'] ?>">
                                <input type="hidden" class="harga-satuan" name="harga[]" value="<?= $p['harga'] ?>">
                            </td>
                            <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                            <td><?= $p['stok'] ?></td>
                            <td>
                                <input type="number" name="jumlah[]" class="form-control input-jumlah"
                                       min="0" max="<?= $p['stok'] ?>" value="0">
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <div class="bg-white p-3 rounded shadow-sm">
                    <h5>Ringkasan</h5>
                    <p>Total Belanja</p>
                    <h4 id="total-tampil">Rp 0</h4>

                    <input type="hidden" name="total_bayar" id="total_bayar" value="0">

                    <div class="mb-2">
                        <label class="form-label">Uang Diberikan</label>
                        <input type="number" name="uang_diberikan" id="uang_diberikan"
                               class="form-control" required>
                    </div>

                    <p>Kembalian: <b id="kembalian-tampil">Rp 0</b></p>

                    <button type="submit" class="btn btn-success w-100">
                        Simpan Transaksi
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
function hitungTotal() {
    let hargaList = document.querySelectorAll('.harga-satuan');
    let jumlahList = document.querySelectorAll('.input-jumlah');
    let total = 0;

    for (let i = 0; i < hargaList.length; i++) {
        let harga = parseInt(hargaList[i].value);
        let jumlah = parseInt(jumlahList[i].value) || 0;
        total += harga * jumlah;
    }

    document.getElementById('total_bayar').value = total;
    document.getElementById('total-tampil').innerText =
        'Rp ' + total.toLocaleString('id-ID');

    hitungKembalian();
}

function hitungKembalian() {
    let total = parseInt(document.getElementById('total_bayar').value) || 0;
    let bayar = parseInt(document.getElementById('uang_diberikan').value) || 0;
    let kembali = bayar - total;

    document.getElementById('kembalian-tampil').innerText =
        'Rp ' + kembali.toLocaleString('id-ID');
}

document.querySelectorAll('.input-jumlah').forEach(el =>
    el.addEventListener('input', hitungTotal)
);

document.getElementById('uang_diberikan').addEventListener(
    'input',
    hitungKembalian
);
</script>

</body>
</html>