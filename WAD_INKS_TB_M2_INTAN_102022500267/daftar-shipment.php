<?php
include 'koneksi.php';
$result = mysqli_query($koneksi, "SELECT * FROM shipments ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shipment Directory</title>
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>

    <h1>Shipment List</h1>

    <table>
        <thead>
            <tr>
                <th>Tracking #</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Service</th>
                <th>Weight</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) == 0) { ?>
            <tr>
                <td colspan="6">Belum ada data.</td>
            </tr>
            <?php } else { while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['tracking_number']) ?></td>
                <td><?= htmlspecialchars($row['sender']) ?></td>
                <td><?= htmlspecialchars($row['receiver']) ?></td>
                <td><?= htmlspecialchars($row['service']) ?></td>
                <td><?= (float) $row['weight'] ?> kg</td>
                <td>
                    <a href="edit.php?id=<?= (int) $row['id'] ?>">Edit</a> |
                    <a href="hapus.php?id=<?= (int) $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>

    <p class="menu"><a href="index.php">Tambah Shipment</a></p>

</body>
</html>
