<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
//ambil data dari URL
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];



//cek apakah tombol submit sudah pernah dipencet atau belum
if( isset($_POST["submit"]) ) {

    //cek apakah data berhasil ubah atau tidak
    if( ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('data BERHASIL diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data GAGAL diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah data</title>
</head>
<body>
    <h1>Ubah Data Mahasiswa</h1>

    <form action="" method="post">
        <ul>
            <li>
                <input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">
            </li>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?php echo $mhs["nama"]; ?>">
            </li>
            <li>
                <label for="npm">NPM :</label>
                <input type="text" name="npm" id="npm" required value="<?php echo $mhs["npm"]; ?>">
            </li><li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" value="<?php echo $mhs["email"]; ?>">
            </li><li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?php echo $mhs["jurusan"]; ?>">
            </li>
            <li>
                <button type="submit" name="submit">Kirim data!</button>
            </button>
        </ul>
    </form>
</body>
</html>