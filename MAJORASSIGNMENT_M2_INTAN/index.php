<!DOCTYPE html>
<html>
<head>
    <title>Input Shipment Data</title>
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>

    <h1>Shipment Entry Form</h1>

    <?php if (isset($_GET['error'])) { ?>
        <p class="pesan"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php } ?>

    <form action="proses-tambah.php" method="post">
        <label>Tracking Number:</label>
        <br>
        <input type="text" name="tracking_number" placeholder="e.g. EXP-1001" required>
        <br><br>

        <label>Sender Name:</label>
        <br>
        <input type="text" name="sender" placeholder="Sender Full Name" required>
        <br><br>

        <label>Receiver Name:</label>
        <br>
        <input type="text" name="receiver" placeholder="Receiver Full Name" required>
        <br><br>

        <label>Shipping Service:</label>
        <br>
        <select name="service">
            <option value="Standard Ground">Standard Ground</option>
            <option value="Next-Day Express">Next-Day Express</option>
            <option value="Cold Chain (Refrigerated)">Cold Chain (Refrigerated)</option>
        </select>
        <br><br>

        <label>Package Weight (kg):</label>
        <br>
        <input type="text" name="weight" placeholder="e.g. 2.5" required>
        <br><br>

        <button type="submit">Add Shipment</button>
    </form>

    <p class="menu"><a href="daftar-shipment.php">Lihat Shipment List</a></p>

</body>
</html>
