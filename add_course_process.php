<?php
session_start();
include "config/db.php";

if (!isset($_POST['save'])) {
    header("Location: manage_courses.php");
    exit;
}

$code = trim($_POST['course_code']);
$name = trim($_POST['course_name']);
$desc = trim($_POST['description']);

if ($code == "" || $name == "") {
    die("All fields required");
}

$sql = "INSERT INTO courses (course_code, course_name, description)
        VALUES ('$code','$name','$desc')";

if (mysqli_query($conn, $sql)) {
    header("Location: manage_courses.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
