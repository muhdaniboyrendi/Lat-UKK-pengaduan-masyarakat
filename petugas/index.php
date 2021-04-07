<?php 

session_start();
require '../function.php';

if(!isset($_SESSION["petugas"])){
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
        <title>petugas</title>
    </head>
    <body>
        <h1>Petugas</h1>
        <a href="verifikasi.php">Verifikasi dan Validasi</a> | 
        <a href="tanggapan.php">Tanggapan</a> | 
        <a href="../logout.php">Logout</a>
    </body>
</html>