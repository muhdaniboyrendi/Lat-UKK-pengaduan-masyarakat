<?php 

session_start();
require '../function.php';

if(!isset($_SESSION["masyarakat"])){
    header("location: ../index.php");
    exit;
}

if(isset($_POST["kirim"])){
    if(pengaduan($_POST) > 0){
        echo "<script>alert('Laporan telah berhasil dikirim');</script>";
    }else{
        echo "<script>alert('Laporan gagal dikirim');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tulis Pengaduan</title>
    </head>
    <body>
        <h1>Tulis Pengaduan</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Laporan</label>
            <br>
            <textarea name="isi_laporan" cols="50" rows="5"></textarea>
            <br>
            <label>foto</label>
            <br>
            <input type="file" name="foto">
            <br><br>
            <button type="submit" name="kirim">Kirim</button>
            <br><br>
            <a href="index.php">Kembali</a>
        </form>
    </body>
</html>