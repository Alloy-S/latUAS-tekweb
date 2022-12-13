<?php
require("../connect.php");
try {
    $resi = $_POST['resi-log'];
    $tanggal = $_POST['tanggal'];
    $kota = $_POST['kota'];
    $keterangan = $_POST['keterangan'];

    $stmt = $conn->prepare("INSERT INTO detail_pengiriman VALUES ('$resi', '$tanggal', '$kota', '$keterangan')");
    $stmt->execute();
} catch (PDOException $e) {
    echo $e;
}


$stmt = $conn->prepare("SELECT * FROM detail_pengiriman WHERE nomor_resi = '$resi' ORDER BY tanggal");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($result as $row) : ?>
    <tr>
        <td><?= $row['tanggal']; ?></td>
        <td><?= $row['kota']; ?></td>
        <td><?= $row['keterangan']; ?></td>
    </tr>
<?php endforeach; ?>