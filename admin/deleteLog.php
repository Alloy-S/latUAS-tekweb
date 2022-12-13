<?php
require('../connect.php');
$resi = $_POST['resi'];

try {
    $stmt = $conn->prepare("DELETE FROM pengiriman WHERE nomor_resi = '$resi'");
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM pengiriman");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
}
?>

<?php foreach ($result as $row) : ?>
    <tr>
        <td><?= $row['tanggal_resi']; ?></td>
        <td><?= $row['nomor_resi']; ?></td>
        <td>
            <a href="entryLogPage.php?resi=<?= $row["nomor_resi"]; ?>">
                <button type="button" class="btn btn-primary entry-log" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?= $row['nomor_resi']; ?>">
                    Entry Log
                </button></a>
            <button class="btn btn-danger delete" value="<?= $row['nomor_resi']; ?>">Delete</button>
        </td>
    </tr>
<?php endforeach; ?>