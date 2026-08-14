<?php
include 'koneksi.php';

$id_produk_list = $_POST['id_produk'] ?? [];
$harga_list     = $_POST['harga'] ?? [];
$jumlah_list    = $_POST['jumlah'] ?? [];
$total_bayar    = (int) ($_POST['total_bayar'] ?? 0);
$uang_diberikan = (int) ($_POST['uang_diberikan'] ?? 0);
$kembalian      = $uang_diberikan - $total_bayar;

if ($total_bayar <= 0) {
    die("Transaksi kosong, pilih minimal 1 produk.");
}
if ($uang_diberikan < $total_bayar) {
    die("Uang yang diberikan kurang dari total belanja.");
}

$kode_transaksi = "TRX-" . date("YmdHis");

// Mulai Transaction Database
mysqli_begin_transaction($koneksi);

try {
    // 1. Simpan header transaksi
    $stmt1 = mysqli_prepare($koneksi, "INSERT INTO transaksi (kode_transaksi, total_bayar, uang_diberikan, kembalian) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt1, "siii", $kode_transaksi, $total_bayar, $uang_diberikan, $kembalian);
    mysqli_stmt_execute($stmt1);
    $id_transaksi = mysqli_insert_id($koneksi);

    // 2. Simpan detail & update stok
    $stmt_get_nama = mysqli_prepare($koneksi, "SELECT nama_produk FROM produk WHERE id_produk = ?");
    $stmt_detail   = mysqli_prepare($koneksi, "INSERT INTO detail_transaksi (id_transaksi, id_produk, nama_produk, harga_satuan, jumlah, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_stok     = mysqli_prepare($koneksi, "UPDATE produk SET stok = stok - ? WHERE id_produk = ?");

    for ($i = 0; $i < count($id_produk_list); $i++) {
        $jumlah = (int) $jumlah_list[$i];
        if ($jumlah <= 0) continue;

        $id_produk = (int) $id_produk_list[$i];
        $harga     = (int) $harga_list[$i];
        $subtotal  = $harga * $jumlah;

        // Ambil nama produk
        mysqli_stmt_bind_param($stmt_get_nama, "i", $id_produk);
        mysqli_stmt_execute($stmt_get_nama);
        $res = mysqli_stmt_get_result($stmt_get_nama);
        $dataProduk = mysqli_fetch_assoc($res);
        $nama_produk = $dataProduk['nama_produk'];

        // Insert detail
        mysqli_stmt_bind_param($stmt_detail, "iissii", $id_transaksi, $id_produk, $nama_produk, $harga, $jumlah, $subtotal);
        mysqli_stmt_execute($stmt_detail);

        // Update stok
        mysqli_stmt_bind_param($stmt_stok, "ii", $jumlah, $id_produk);
        mysqli_stmt_execute($stmt_stok);
    }

    // Jika semua berhasil, simpan permanen
    mysqli_commit($koneksi);
    header("Location: struk.php?id=$id_transaksi");
    exit;

} catch (Exception $e) {
    // Jika ada error, batalkan semua perubahan
    mysqli_rollback($koneksi);
    die("Gagal menyimpan transaksi: " . $e->getMessage());
}
?>