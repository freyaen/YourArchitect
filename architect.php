<?php
session_start();
if ($_SESSION['role'] != 'architect') {
    header("Location: login.php");
    exit();
}
echo "Welcome, Architect " . $_SESSION['nama'];
// Add architect-specific content here
?>
