<?php 

// Koneksi
$conn = mysqli_connect("localhost", "root", "", "pengaduan-masyarakat");


// fatch data
function data($query){
    global $conn;
    $query = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }
    return $rows;
}


// registrasi
function register($data){
    global $conn;

    $nik = $data['nik'];
    $nama = $data['nama'];
    $username = $data['username'];
    $password = $data['password'];
    $confirmpassword = $data["password2"];
    $telp = $data['telp'];

    $result = mysqli_query($conn, "SELECT username FROM masyarakat WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>alert('Username talah terdaftar')</script>";
        return false;
    }

    if($password !== $confirmpassword){
        echo "<script>alert('Password tidak bisa dikonfirmasi')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO masyarakat VALUES('$nik', '$nama', '$username', '$password', '$telp')");
    return mysqli_affected_rows($conn);
}


// daftar
function daftar($data){
    global $conn;

    $nama = $data['nama_petugas'];
    $username = $data['username'];
    $password = $data['password'];
    $confirmpassword = $data["password2"];
    $telp = $data['telp'];
    $level = $data['level'];

    $result = mysqli_query($conn, "SELECT username FROM petugas WHERE username = '$username'");
    $result2 = mysqli_query($conn, "SELECT username FROM masyarakat WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>alert('Username talah terdaftar')</script>";
        return false;
    }
    if(mysqli_fetch_assoc($result2)){
        echo "<script>alert('Username talah terdaftar')</script>";
        return false;
    }

    if($password !== $confirmpassword){
        echo "<script>alert('Password tidak bisa dikonfirmasi')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO petugas VALUES('', '$nama', '$username', '$password', '$telp', '$level')");
    return mysqli_affected_rows($conn);
}


// pengaduan
function pengaduan($data){
    global $conn;

    $tgl = date("Y-m-d");
    $nik = $_SESSION["data"]["nik"];
    $isi = $data["isi_laporan"];
    $status = "0";
    $foto = upload();
    if(!$foto){
        return false;
    }

    mysqli_query($conn, "INSERT INTO pengaduan VALUES('', '$tgl', '$nik', '$isi', '$foto', '$status')");
    return mysqli_affected_rows($conn);
}


// upload
function upload(){
    $namaFile = $_FILES['foto']['name'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if($error === 4){
        echo "<script>alert('Laporan harus disertakan foto');</script>";
        return false;
    }

    $formatFotoValid = ['jpg', 'jpeg', 'png'];
    $formatFoto = explode('.', $namaFile);
    $formatFoto = strtolower(end($formatFoto));
    if(!in_array($formatFoto, $formatFotoValid)){
        echo "<script>alert('File harus berupa foto');</script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $formatFoto;

    move_uploaded_file($tmpName, '../vendor/img/' . $namaFileBaru);
    return $namaFileBaru;
}


// tanggapan
function tanggapan($data){
    global $conn;

    $id = $_GET["id"];
    $tgl = date("Y-m-d");
    $tanggapan = $data["tanggapan"];
    $id_petugas = $_SESSION["data"]["id_petugas"];

    mysqli_query($conn, "INSERT INTO tanggapan VALUES('', '$id', '$tgl', '$tanggapan', '$id_petugas')");
    mysqli_query($conn, "UPDATE pengaduan SET status = 'selesai' WHERE id_pengaduan = '$id'");

    return mysqli_affected_rows($conn);
}

?>