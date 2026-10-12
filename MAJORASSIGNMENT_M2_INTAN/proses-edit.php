<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: daftar-shipment.php");
    exit();
}

$id       = (int) $_POST['id'];
$tracking = trim($_POST['tracking_number']);
$sender   = trim($_POST['sender']);
$receiver = trim($_POST['receiver']);
$service  = trim($_POST['service']);
$weight   = (float) str_replace(',', '.', $_POST['weight']);

if ($tracking === '' || $sender === '' || $receiver === '' || $service === '' || $weight <= 0) {
    header("Location: edit.php?id=$id&error=" . urlencode("Semua kolom wajib diisi, berat harus berupa angka."));
    exit();
}

$stmt = mysqli_prepare($koneksi,
    "UPDATE shipments SET tracking_number = ?, sender = ?, receiver = ?, service = ?, weight = ? WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ssssdi", $tracking, $sender, $receiver, $service, $weight, $id);

try {
    mysqli_stmt_execute($stmt);
    header("Location: daftar-shipment.php");
    exit();
} catch (mysqli_sql_exception $e) {
    $pesan = ($e->getCode() == 1062) ? "Tracking number sudah dipakai data lain." : "Gagal mengubah data.";
    header("Location: edit.php?id=$id&error=" . urlencode($pesan));
    exit();
}
?>
