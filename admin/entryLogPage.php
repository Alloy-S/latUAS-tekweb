<?php
session_start();
require("../connect.php");
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}


require("../connect.php");

$username = $_SESSION['username'];
$resi = strtoupper($_GET['resi']);
$stmt = $conn->prepare("SELECT * FROM detail_pengiriman WHERE nomor_resi = '$resi' ORDER BY tanggal");
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
            $("#submit-log").click(function(e) {
                e.preventDefault();

                var dataLog = $("#entry-log");
                $.ajax({
                    type: "POST",
                    url: "entryLog.php",
                    data: dataLog.serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response == "eror") {
                            // alert("eror");
                            $("#eror-box").html("<div class='alert alert-danger mt-2' role='alert'>Nomor resi sudah ada</div>");
                        } else {
                            $('tbody').html(response);
                        }
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
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
                    <a class="nav-link" href="#">User Admin</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar -->
    <div class="container-fluid d-flex flex-column">
        <div class="w-25 mb-2">
            <div>
                <h2>Entry Log Nomor Resi</h2>
            </div>
            <form action="" id="entry-log" method="POST">
                <input type="hidden" value="<?= $resi; ?>" name="resi-log">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control">
                <label for="resi">Kota:</label>
                <input type="text" class="form-control" name="kota" id="kota">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan"  rows="5" class="form-control"></textarea>
                <!-- <input type="text" class="form-control" name="jenis" id="jenis"> -->

                <div id="eror-box"></div>

                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-dark" name="submit" id="submit-log">Entry</button>
                </div>
            </form>
        </div>
        <div class="table-log mt-3">
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
        </div>
    </div>
</body>

</html>