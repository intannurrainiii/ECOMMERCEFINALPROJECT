<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";        // Laragon: password kosong
$db   = "shipment_db";
$port = 3306;

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
