<?php
require("../connect.php");

$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama'];

$stmt = $conn->prepare("SELECT username FROM user WHERE username = '$username'");
$stmt->execute();

$result = $stmt->fetchColumn();
if ($result > 0) {
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user VALUES(null, '$username', '$password', '$nama', 1)");
    $stmt->execute();
}

header("Location: adminSetting.php");
