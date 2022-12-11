<?php
session_start();
require("../connect.php");

if (isset($_SESSION['login'])) {
    header("Location: index.php");
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $stmt = $conn->prepare("SELECT username, password FROM user_admin WHERE username = '$username'");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if (password_verify($password, $result['password'])) {

                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                header("Location: index.php");
            }
        }
    } catch (PDOException $e) {
        echo "eror";
    }

    $eror = true;
}
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
    <style>
        .container-fluid {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="login-form border w-25">
            <div class="bg-black text-white text-center py-2">
                <h1>WELCOME!</h1>
            </div>
            <div class="p-2">
                <form action="" method="POST">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control">

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <?php if (isset($eror)) : ?>
                        <p>username/password salah!</p>
                    <?php endif; ?>
                    <div class="d-grid gap-2">
                        <button type="submit" name="login" class="btn btn-dark mt-2">Login</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>