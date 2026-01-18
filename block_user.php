<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// Admin ha is xirin
if ($id == $_SESSION['user_id']) {
    header("Location: manage_users.php");
    exit;
}

mysqli_query($conn, "UPDATE users SET user_status='not active' WHERE id='$id'");

header("Location: manage_users.php");
exit;
?>
