<?php


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
            $("#cari").click(function() {
                $.ajax({
                    type: "POST",
                    url: "cariResi.php",
                    data: {
                        resi: $("#cari-resi").val()
                    },
                    success: function(response) {
                        $('.table-resi').html(response);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Welcome</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="admin/login.php">Login Admin</a>

                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid ">
        <div class="border mt-2">
            <div class="p-3">
                <div class="mt-2 ">
                    <div class="cari-resi w-25">
                        <h1 class="m-3">Cek Pengiriman</h1>

                        <div class="d-flex flex-row align-items-center">
                            <input type="text" id="cari-resi" class="form-control" placeholder="Nomor pengiriman">
                            <button class="btn btn-dark btn-sm ms-1" id="cari">Lihat</button>
                        </div>
                    </div>
                </div>
                <div class="table-resi mt-4">

                </div>
            </div>
        </div>
</body>

</html>