<?php 
require("../connect.php");
try {
$username = $_POST['username'];
$stmt = $conn->prepare("UPDATE user SET status_aktif = 0 WHERE username = '$username'");
$stmt->execute();
} catch(PDOException $e){

}
?>