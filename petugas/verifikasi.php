<?php 

session_start();
require '../function.php';

if(!isset($_SESSION["petugas"])){
    header("location: ../index.php");
    exit;
}

$pengaduan = data("SELECT * FROM pengaduan 
                    INNER JOIN masyarakat 
                    ON pengaduan.nik = masyarakat.nik 
                    WHERE status = '0'");

if(isset($_POST["verify"])){
    $id_pengaduan = $_POST["verify"];
    $_SESSION["id_pengaduan"] = $id_pengaduan;
    $query = mysqli_query($conn, "UPDATE pengaduan SET status = 'proses' WHERE id_pengaduan = $id_pengaduan");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verifikasi dan Validasi</title>
    </head>
    <body>
        <h1>Verifikasi dan Validasi</h1>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Laporan</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($pengaduan as $data): ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data["nama"]; ?></td>
                <td><?= $data["isi_laporan"]; ?></td>
                <td><img src="../vendor/img/<?= $data["foto"]; ?>" width="100px"></td>
                <td><?= $data["status"]; ?></td>
                <form action="" method="POST">
                    <td><button type="submit" name="verify" value="<?= $data['id_pengaduan']; ?>">Verifikasi</button></td>
                </form>
            </tr>
            <?php endforeach; ?>
            <?php $i++; ?>
        </table>
        <br>
        <a href="index.php">Kembali</a>
    </body>
</html>