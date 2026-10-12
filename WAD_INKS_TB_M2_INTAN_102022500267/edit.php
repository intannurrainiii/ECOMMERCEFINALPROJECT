<?php
include 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($koneksi, "SELECT * FROM shipments WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) {
    header("Location: daftar-shipment.php");
    exit();
}
$layanan = ["Standard Ground", "Next-Day Express", "Cold Chain (Refrigerated)"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Shipment Data</title>
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>

    <h1>Edit Shipment</h1>

    <?php if (isset($_GET['error'])) { ?>
        <p class="pesan"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php } ?>

    <form action="proses-edit.php" method="post">
        <input type="hidden" name="id" value="<?= (int) $data['id'] ?>">

        <label>Tracking Number:</label>
        <br>
        <input type="text" name="tracking_number" value="<?= htmlspecialchars($data['tracking_number']) ?>" required>
        <br><br>

        <label>Sender Name:</label>
        <br>
        <input type="text" name="sender" value="<?= htmlspecialchars($data['sender']) ?>" required>
        <br><br>

        <label>Receiver Name:</label>
        <br>
        <input type="text" name="receiver" value="<?= htmlspecialchars($data['receiver']) ?>" required>
        <br><br>

        <label>Shipping Service:</label>
        <br>
        <select name="service">
            <?php foreach ($layanan as $l) { ?>
                <option value="<?= $l ?>" <?= $data['service'] === $l ? 'selected' : '' ?>><?= $l ?></option>
            <?php } ?>
        </select>
        <br><br>

        <label>Package Weight (kg):</label>
        <br>
        <input type="text" name="weight" value="<?= (float) $data['weight'] ?>" required>
        <br><br>

        <button type="submit">Save Changes</button>
    </form>

    <p class="menu"><a href="daftar-shipment.php">Kembali ke Shipment List</a></p>

</body>
</html>
