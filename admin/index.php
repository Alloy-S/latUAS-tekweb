<?php
session_start();
require("../connect.php");
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT nama_admin FROM user WHERE username = '$username'");
$stmt->execute();

$username = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $username['nama_admin'];

$stmt = $conn->prepare("SELECT * FROM pengiriman");
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

            $("#submit-resi").click(function(e) {
                e.preventDefault();
                var dataResi = $("#entry-resi")

                $.ajax({
                    type: "POST",
                    url: "entryNomorResi.php",
                    data: dataResi.serialize(),
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
            })

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
                    <a class="nav-link" href="adminSetting.php">User Admin</a>
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
                    <form action="" id="entry-resi" method="POST">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                        <label for="resi">Resi</label>
                        <input type="text" class="form-control" name="resi" id="resi">
                        <label for="jenis">Jenis Pengiriman</label>
                        <input type="text" class="form-control" name="jenis" id="jenis">

                        <div id="eror-box"></div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-dark" name="submit" id="submit-resi">Entry</button>
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
                                    <td><?= date($row['tanggal_resi']); ?></td>
                                    <td><?= $row['nomor_resi']; ?></td>
                                    <td>
                                        <a href="entryLogPage.php?resi=<?= $row["nomor_resi"]; ?>">
                                            <button type="button" class="btn btn-primary entry-log">
                                                Entry Log
                                            </button></a>
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

    
</body>

</html>