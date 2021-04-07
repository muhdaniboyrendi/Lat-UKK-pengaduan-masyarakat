<?php 

session_start();
require 'function.php';

if(isset($_SESSION["masyarakat"])){
    header("location: masyaraakt/");
    exit;
}
if(isset($_SESSION["admin"])){
    header("location: admin/");
    exit;
}
if(isset($_SESSION["petugas"])){
    header("location: petugas/");
    exit;
}

if(isset($_POST["register"])){
    if(register($_POST) > 0){
        echo "<script>alert('Akun anda berhasil terdaftar')</script>";
    }else{
        echo "<script>alert('Akun anda gagal terdaftar')</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
    </head>
    <body>
        <form action="" method="POST">
            <label>NIK</label>
            <input type="text" name="nik" required>
            <br>
            <label>Nama</label>
            <input type="text" name="nama" required>
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
            <button type="submit" name="register">Daftar</button>
            <br>
            <a href="index.php">Sudah punya akun? Login</a>
        </form>
    </body>
</html>