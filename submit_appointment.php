<?php
session_start();
$servername = "localhost";  // Typically "localhost" for XAMPP
$username = "root";  // Default XAMPP username
$password = "";  // Default XAMPP password is empty
$dbname = "archi_db";  // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!isset($_SESSION['logged']) && !$_SESSION['logged']){
    header("Location: login.php");
  }

  $date = $_POST['date'];
  $message = $_POST['message'];
  $id_user = $_SESSION['id_user'];
  $id_arsitek = $_POST['id_arsitek'];

  $sql = "INSERT INTO appointments (date, message, id_arsitek, id_user) VALUES ('$date', '$message', $id_arsitek, $id_user)";

  if ($conn->query($sql) === TRUE) {
    header('Location: riwayat_appointment.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
