<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$tracking = trim($_POST['tracking_number']);
$sender   = trim($_POST['sender']);
$receiver = trim($_POST['receiver']);
$service  = trim($_POST['service']);
$weight   = (float) str_replace(',', '.', $_POST['weight']);

if ($tracking === '' || $sender === '' || $receiver === '' || $service === '' || $weight <= 0) {
    header("Location: index.php?error=" . urlencode("Semua kolom wajib diisi, berat harus berupa angka."));
    exit();
}

$stmt = mysqli_prepare($koneksi,
    "INSERT INTO shipments (tracking_number, sender, receiver, service, weight) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssd", $tracking, $sender, $receiver, $service, $weight);

try {
    mysqli_stmt_execute($stmt);
    header("Location: daftar-shipment.php");
    exit();
} catch (mysqli_sql_exception $e) {
    $pesan = ($e->getCode() == 1062) ? "Tracking number sudah terdaftar." : "Gagal menyimpan data.";
    header("Location: index.php?error=" . urlencode($pesan));
    exit();
}
?>
