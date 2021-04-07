<?php 

session_start();
require '../function.php';

if(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;
}

if(isset($_POST["daftar"])){
    if(daftar($_POST) > 0){
        echo "<script>alert('Akun telah berhasil dibuat')</script>";
    }else{
        echo "<script>alert('Akun gagal dibuat')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrasi</title>
    </head>
    <body>
        <h1>Registrasi</h1>
        <form action="" method="POST">
            <label>Nama</label>
            <input type="text" name="nama_petugas" required>
            <br>
            <label>Username</label>
            <input type="text" name="username" required>
            <br>
            <label>Password</label>
            <input type="password" name="password" required>
            <br>
            <label>Konfirmasi Password</label>
            <input type="password" name="password2" required>
            <br>
            <label>Telepone</label>
            <input type="text" name="telp" required>
            <br>
            <label>Level</label>
            <select name="level">
                <option></option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>
            <br><br>
            <button type="submit" name="daftar">Daftar</button>
            <br><br>
            <a href="index.php">Kembali</a>
        </form>
    </body>
</html>