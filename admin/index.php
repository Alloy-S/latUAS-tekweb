<?php
session_start();
require("../connect.php");
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT nama_admin FROM user_admin WHERE username = '$username'");
$stmt->execute();

$username = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $username['nama_admin'];

$stmt = $conn->prepare("SELECT * FROM transaksi_resi_pengiriman");
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
            $('body').on("click", ".entry-log", function() {
                console.log($(this).val());
                $("#judul-entry").html($(this).val());
                $("#resi-log").val($(this).val());
            });

            $('body').on("click", ".delete", function() {
                $.ajax({
                    type: "POST",
                    url: "deleteLog.php",
                    data: {
                        resi: $(this).val()
                    },
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
                    <a class="nav-link active" aria-current="page" href="#">Data Resi Pengiriman</a>
                    <a class="nav-link" href="#">User Admin</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar -->
    <div class="container-fluid">
        <div class="border mt-2">
            <div class="p-3">


                <div class="input-resi w-25 p-2">
                    <h1>Entry Nomor Resi</h1>
                    <form action="entryNomorResi.php" method="POST">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                        <label for="resi">Resi</label>
                        <input type="text" class="form-control" name="resi" id="resi">
                        <label for="jenis">Jenis Pengiriman</label>
                        <input type="text" class="form-control" name="jenis" id="jenis">

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-dark" name="submit">Entry</button>
                        </div>
                    </form>
                </div>
                <div class="table-resi">
                    <table class="table table-bordered">
                        <thead class="bg-dark text-white">
                            <th>Tanggal Resi</th>
                            <th>Nomor Resi</th>
                            <th>Action</th>

                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) : ?>
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
                            <?php endforeach; ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Entry Log <span id="judul-entry"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="entrylog.php" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="resi-log" id="resi-log">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">

                        <label for="kota">Kota</label>
                        <input type="text" class="form-control" name="kota" id="kota">

                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>