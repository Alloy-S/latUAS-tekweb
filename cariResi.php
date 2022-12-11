<?php
require("connect.php");
$resi = strtoupper($_POST['resi']);
$stmt = $conn->prepare("SELECT * FROM detail_log_pengiriman WHERE nomor_resi = '$resi' ORDER BY tanggal");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$result) {
    echo "Resi Tidak di Temukan";
} else {
?>
    <table class="table table-bordered">
        <thead class="bg-dark text-white">
            <th>Tanggal</th>
            <th>Kota</th>
            <th>Keterangan</th>

        </thead>
        <tbody>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['kota']; ?></td>
                    <td><?= $row['keterangan']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>