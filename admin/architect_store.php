<?php
require_once '../db_connect.php';

if (isset($_POST['proses'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $id_spesialis = $_POST['id_spesialis'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Menggunakan bcrypt untuk hash password

    // Menyimpan data ke dalam tabel user
    $query = "INSERT INTO user (role,id_spesialis, password, nama, alamat, email, no_hp) VALUES ('architect', $id_spesialis, '$password', '$nama', '$alamat', '$email', '$no_hp')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Berhasil menambahkan data'
        ];
        header('Location: architect.php');
    } else {
        $_SESSION['info'] = [
            'status' => 'failed',
            'message' => mysqli_error($conn)
        ];
    }
}
?>
