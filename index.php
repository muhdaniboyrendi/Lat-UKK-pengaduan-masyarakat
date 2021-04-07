<?php 

session_start();
require 'function.php';

if(isset($_SESSION["masyarakat"])){
    header("location: masyarakat/");
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

if(isset($_POST["login"])){
    global $conn;

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username'");
    $cek = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    $result2 = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username'");
    $cek2 = mysqli_num_rows($result2);
    $row2 = mysqli_fetch_assoc($result2);

    if($cek > 0){
        if(password_verify($password, $row["password"])){
            $_SESSION["masyarakat"] = true;
            $_SESSION["data"] = $row;
            header("location: masyarakat/");
            exit;
        }
    }

    if($cek2 > 0){
        if(password_verify($password, $row2["password"])){
            if($row2["level"] == "admin"){
                $_SESSION["admin"] = true;
                $_SESSION["data"] = $row2;
                header("location: admin/");
                exit;
            }
            if($row2["level"] == "petugas"){
                $_SESSION["petugas"] = true;
                $_SESSION["data"] = $row2;
                header("location: petugas/");
                exit;
            }
        }
    }
    echo "<script>
                alert('Username atau password yang anda masukan salah')
            </script";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <form action="" method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <br>
            <label>Password</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit" name="login">Login</button>
            <br>
            <a href="register.php">Belun punya akun? Daftar</a>
        </form>
    </body>
</html>