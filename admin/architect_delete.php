<?php
session_start();
require_once '../db_connect.php';

$id_user = $_GET['id_user'];

$result = mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'");

if (mysqli_affected_rows($conn) > 0) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menghapus data'
  ];
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($conn)
  ];
}

header('Location: ./architect.php');
exit();
?>
