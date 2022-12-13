<?php
session_start();
require("../connect.php");
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}


require("../connect.php");
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('body').on("click", ".delete", function() {
                $.ajax({
                    type: "POST",
                    url: "deleteAdmin.php",
                    data: {
                        username: $(this).val()
                    },
                    success: function(response) {
                        $('tbody').html(response);
                    }
                });
            });

            $('body').on("click", ".status", function() {
                $.ajax({
                    type: "POST",
                    url: "editStatusAdmin.php",
                    data: {
                        username: $(this).val()
                    },
                    success: function(response) {
                        alert("suskes menonaktifkan");
                    }
                });
            });

            $('body').on("click", ".edit-admin", function() {
                var dataAdmin = $("#data-admin");
                $.ajax({
                    type: "POST",
                    url: "editAdmin.php",
                    data: dataAdmin.serialize(),
                    success: function(response) {
                        $('tbody').html(response);
                    }
                });
            });
        });

    </script>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Halo, <?= $username; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="index.php">Data Resi Pengiriman</a>
                    <a class="nav-link active" href="#">User Admin</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar -->

    <div class="container-fluid ">
        <div class="add-baru m-3">
            <button type="button" class="btn btn-primary entry-log" data-bs-toggle="modal" data-bs-target="#addAdmin" value="<?= $row['nomor_resi']; ?>">
                Add Admin
            </button>
        </div>
        <div class="table-admin">
            <table class="table table-bordered">
                <thead class="bg-dark text-white">
                    <th>username</th>
                    <th>nama</th>
                    <th>Action</th>

                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?= $row['username']; ?></td>
                            <td><?= $row['nama_admin']; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary dit-admin" data-bs-toggle="modal" data-bs-target="#editAdmin" value="<?= $row['username']; ?>">
                                    Edit
                                </button>
                                <button class="btn btn-warning status" value="<?= $row['username']; ?>" status="<?= $row['status_aktif']; ?>">non-aktif</button>
                                <button class="btn btn-danger delete" value="<?= $row['username']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>


            </table>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Admin<span id="judul-entry"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="addNewAdmin.php" method="POST">
                    <div class="modal-body">

                        <label for="Usernmae">Username</label>
                        <input type="text" name="username" id="usernmae" class="form-control">

                        <label for="password">password</label>
                        <input type="text" class="form-control" name="password" id="password">

                        <label for="nama">Nama Admin</label>
                        <input type="text" name="nama" id="nama" class="form-control">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal -->

    <!-- modal -->
    <div class="modal fade" id="editAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin<span id="judul-entry"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="editAdmin.php" method="POST">
                    <div class="modal-body">

                        <label for="Usernmae">Username</label>
                        <input type="text" name="username" id="usernmae" class="form-control">

                        <label for="password">password</label>
                        <input type="text" class="form-control" name="password" id="password">

                        <label for="nama">Nama Admin</label>
                        <input type="text" name="nama" id="nama" class="form-control">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal -->
</body>

</html>