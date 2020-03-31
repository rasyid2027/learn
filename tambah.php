<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
//cek apakah tombol submit sudah pernah dipencet atau belum
if( isset($_POST["submit"]) ) {

    //cek apakah data berhasil ditabahkan atau tidak
    if( tambah($_POST) > 0 ) {
        echo "
            <script>
                alert('data BERHASIL ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data GAGAL ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah data</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="npm">NPM :</label>
                <input type="text" name="npm" id="npm" required>
            </li><li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email">
            </li><li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <button type="submit" name="submit">Kirim data!</button>
            </button>
        </ul>
    </form>
</body>
</html>