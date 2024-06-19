<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $link = $_POST['link'];
    $query = "UPDATE appointments SET link = '$link' WHERE id = $appointment_id";
    $stmt = $conn->query($query);

    if ($stmt) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $query]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
