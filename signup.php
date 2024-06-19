<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO user (nama, email, no_hp, alamat, password) VALUES ('$name', '$email','$no_hp', '$alamat', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the login page after successful registration
        echo "<script>alert('Registration successful! Redirecting to login page...'); window.location.href = 'login.php';</script>";
        exit(); // Make sure to call exit to stop script execution after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
