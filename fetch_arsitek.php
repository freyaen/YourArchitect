<?php
include 'db_connect.php'; // Include your database connection file

if(isset($_POST['id_spesialis'])) {
  $id_spesialis = $_POST['id_spesialis'];

  $query = "SELECT * FROM user WHERE role = 'architect' AND id_spesialis = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $id_spesialis);
  $stmt->execute();
  $result = $stmt->get_result();

  echo '<option selected disabled>Pilih Arsitek</option>';
  while($row = $result->fetch_assoc()) {
    echo '<option value="' . $row['id_user'] . '">' . $row['nama'] . '</option>';
  }

  $stmt->close();
  $conn->close();
}
?>
