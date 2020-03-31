<?php
//konesti ke database
$conn = mysqli_connect("localhost", "root", "password", "phpdasar");


function query($qwery) {
    global $conn;
    $result = mysqli_query($conn, $qwery);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $npm = htmlspecialchars($data["npm"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $query = "INSERT INTO mahasiswa
                VALUES
                (NULL, '$nama', '$npm', '$email', '$jurusan')
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $npm = htmlspecialchars($data["npm"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $query = "UPDATE mahasiswa SET
                nama = '$nama',
                npm = '$npm',
                email = '$email',
                jurusan = '$jurusan'
              WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    
}

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa
                WHERE 
             nama LIKE '%$keyword%' OR
             npm  LIKE '%$keyword%' OR
             email  LIKE '%$keyword%' OR
             jurusan LIKE '%$keyword%'
            ";

    return query($query);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek apakah username sudah ada atau belom
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah terdaftar');
              </script>";

        return false;
    }

    //cek konfirmasi pw
    if( $password !== $password2 ) {
        echo "<script>
                    alert('konfirmasi password tidak sesuai!');
             </script>";
        
        return false;
    }

    //enkripsi pw
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES(NULL, '$username', '$password')");

    return mysqli_affected_rows($conn);
    
}

?>