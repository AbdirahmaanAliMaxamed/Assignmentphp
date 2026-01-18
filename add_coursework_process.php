<?php
session_start();
include "config/db.php";

if (!isset($_POST['save'])) {
    header("Location: manage_courseworks.php");
    exit;
}

$course_id  = $_POST['course_id'];
$title      = trim($_POST['title']);
$desc       = trim($_POST['description']);
$due_date   = $_POST['due_date'];

$sql = "INSERT INTO courseworks (course_id, title, description, due_date)
        VALUES ('$course_id', '$title', '$desc', '$due_date')";

if (mysqli_query($conn, $sql)) {
    header("Location: manage_courseworks.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
