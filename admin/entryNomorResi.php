<?php 
require("../connect.php");

try {
$tanggal = $_POST['tanggal'];
$resi = strtoupper($_POST['resi']);
$jenis = $_POST['jenis'];

$stmt = $conn->prepare("INSERT INTO transaksi_resi_pengiriman VALUES ('$resi', '$tanggal', '$jenis')");
$stmt->execute();
} catch(PDOException $e) {
    echo $e;
}

header("Location: index.php");

?>