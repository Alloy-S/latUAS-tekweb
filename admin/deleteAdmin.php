<?php
require('../connect.php');
$username = $_POST['username'];

try {
    $stmt = $conn->prepare("DELETE FROM user WHERE username = '$username'");
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM user");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
}
?>

<?php foreach ($result as $row) : ?>
    <tr>
        <td><?= $row['username']; ?></td>
        <td><?= $row['nama_admin']; ?></td>
        <td>
            <button type="button" class="btn btn-primary entry-log" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?= $row['username']; ?>">
                Edit
            </button>
            <button class="btn btn-warning status" value="<?= $row['username']; ?>" status="<?= $row['status_aktif']; ?>">non-aktif</button>
            <button class="btn btn-danger delete" value="<?= $row['username']; ?>">Delete</button>
        </td>
    </tr>
<?php endforeach; ?>