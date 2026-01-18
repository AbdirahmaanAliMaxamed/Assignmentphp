<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM courses WHERE id=$id");

header("Location: manage_courses.php");
exit;
