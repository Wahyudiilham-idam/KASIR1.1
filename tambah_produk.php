<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width:500px">
    <h3>Tambah Produk</h3>

    <form action="proses_tambah.php" method="POST" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="Umum">
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>

    </form>
</div>
</body>
</html>