<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION['logged']) && !$_SESSION['logged']) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $note = $_POST['note'];
    $attachment = $_FILES['attachment'];

    // Upload file if exists
    if ($attachment['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'lampiran/';
        $upload_file = $upload_dir . basename($attachment['name']);

        if (move_uploaded_file($attachment['tmp_name'], $upload_file)) {
            $file_path = $upload_file;
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to upload file']);
            exit;
        }
    } else {
        $file_path = null;
    }

    $stmt = $conn->prepare("INSERT INTO reports (appointment_id, catatan, lampiran) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $appointment_id, $note, $file_path);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to submit report']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
