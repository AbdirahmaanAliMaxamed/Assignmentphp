<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($conn, "UPDATE users SET user_status='active' WHERE id='$id'");

header("Location: manage_users.php");
exit;
?>
