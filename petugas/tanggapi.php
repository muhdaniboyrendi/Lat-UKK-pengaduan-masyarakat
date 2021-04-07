<?php 

session_start();
require '../function.php';

if(!isset($_SESSION["petugas"])){
    header("location: ../index.php");
    exit;
}

if(isset($_POST["tanggapi"])){
    if(tanggapan($_POST) > 0){
        echo "<script>alert('Laporan berhasil ditanggapi')</script>";
        header("location: tanggapan.php");
        exit;
    }else{
        echo "<script>alert('Laporan gagal ditanggapi')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tanggapi</title>
    </head>
    <body>
        <h1>Tulis Tanggapan</h1>
        <form action="" method="POST">
            <textarea name="tanggapan" cols="30" rows="5" required></textarea>
            <br><br>
            <button type="submit" name="tanggapi">Tanggapi</button>
        </form>
    </body>
</html>