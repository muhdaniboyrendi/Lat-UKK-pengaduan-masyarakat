<?php 

session_start();
require '../function.php';

if(!isset($_SESSION["masyarakat"])){
    header("location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>masyarakat</title>
    </head>
    <body>
        <h1>Masyarakat</h1>
        <a href="pengaduan.php">Tulis Pengaduan</a> | 
        <a href="../logout.php">Logout</a>
    </body>
</html>