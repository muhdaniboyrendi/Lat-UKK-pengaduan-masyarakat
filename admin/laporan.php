<?php 

session_start();
require '../function.php';

if(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;
}

$laporan = data("SELECT * FROM masyarakat
                    INNER JOIN pengaduan
                    ON masyarakat.nik = pengaduan.nik
                    INNER JOIN tanggapan
                    ON pengaduan.id_pengaduan = tanggapan.id_pengaduan
                    INNER JOIN petugas
                    ON tanggapan.id_petugas = petugas.id_petugas
                    WHERE status = 'selesai'");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Generate Laporan</title>
    </head>
    <body>
        <h1>Generete Laporan</h1>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Isi Laporan</th>
                <th>Tanggapan</th>
                <th>Petugas</th>
                <th>Foto</th>
                <th>Status</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($laporan as $item): ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $item["nama"]; ?></td>
                <td><?= $item["nik"]; ?></td>
                <td><?= $item["isi_laporan"]; ?></td>
                <td><?= $item["tanggapan"]; ?></td>
                <td><?= $item["nama_petugas"]; ?></td>
                <td>
                    <img src="../vendor/img/<?= $item['foto']; ?>" width="100px">
                </td>
                <td><?= $item["status"]; ?></td>
            </tr>
            <?php endforeach; ?>
            <?php $i++; ?>
        </table>
        <br>
        <a href="index.php">Kembali</a>
    </body>
</html>