<?php
include 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id) {
    $stmt = mysqli_prepare($koneksi, "DELETE FROM shipments WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: daftar-shipment.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: daftar-shipment.php");
    exit();
}
?>
