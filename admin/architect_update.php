<?php
session_start();
require_once '../db_connect.php';

if (isset($_POST['proses'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $id_spesialis = $_POST['id_spesialis'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    // Menggunakan query untuk mengupdate data pengguna
    $query = "UPDATE user SET 
                nama='$nama', 
                id_spesialis='$id_spesialis', 
                alamat='$alamat', 
                email='$email', 
                no_hp='$no_hp'
              WHERE id_user=$id_user";

    if (mysqli_query($conn, $query)) {
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Berhasil mengubah data'
        ];
    } else {
        $_SESSION['info'] = [
            'status' => 'failed',
            'message' => mysqli_error($conn)
        ];
    }

    header('Location: ./architect.php');
    exit();
}
?>
