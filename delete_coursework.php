<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($conn, "DELETE FROM courseworks WHERE id=$id");
}

header("Location: manage_courseworks.php");
exit;
