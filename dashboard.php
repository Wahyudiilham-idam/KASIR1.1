<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>hello world</h2>

    <a href="logout.php" onclick="return confirm('Yakin ingin keluar?');">Logout</a>
</body>
</html>