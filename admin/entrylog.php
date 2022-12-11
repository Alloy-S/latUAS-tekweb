<?php 
require("../connect.php");
try {
$resi = $_POST['resi-log'];
$tanggal = $_POST['tanggal'];
$kota = $_POST['kota'];
$keterangan = $_POST['keterangan'];

$stmt = $conn->prepare("INSERT INTO detail_log_pengiriman VALUES ('$resi', '$tanggal', '$kota', '$keterangan')");
$stmt->execute();
} catch (PDOException $e) {
    echo $e;
}

header("Location: index.php");
?>