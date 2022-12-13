<?php
require("../connect.php");

try {
    $tanggal = $_POST['tanggal'];
    $resi = strtoupper($_POST['resi']);
    $jenis = $_POST['jenis'];

    $stmt = $conn->prepare("INSERT INTO pengiriman VALUES ('$resi', '$tanggal', '$jenis')");
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM pengiriman");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($result)) {

        ?>
    <?php    foreach ($result as $row) : ?>
            <tr>
                <td><?= $row['tanggal_resi']; ?></td>
                <td><?= $row['nomor_resi']; ?></td>
                <td>
                    <button type="button" class="btn btn-primary entry-log" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?= $row['nomor_resi']; ?>">
                        Entry Log
                    </button>
                    <button class="btn btn-danger delete" value="<?= $row['nomor_resi']; ?>">Delete</button>
                </td>
            </tr>
    <?php
        endforeach;
    }

} catch (PDOException $e) {
    echo "eror";
}

