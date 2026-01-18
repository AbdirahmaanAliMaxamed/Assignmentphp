<?php
session_start();
include "config/db.php";

if (!isset($_POST['submit'])) {
    header("Location: register.php");
    exit;
}

$first_name = trim($_POST['first_name']);
$last_name  = trim($_POST['last_name']);
$sex        = $_POST['sex'];
$username   = trim($_POST['username']);
$password   = $_POST['password'];
$phone      = trim($_POST['phone']);
$email      = trim($_POST['email']);
$user_type  = $_POST['user_type'];

// Basic validation
if (empty($first_name) || empty($last_name) || empty($username) || empty($password)) {
    header("Location: register.php?error=All required fields must be filled");
    exit;
}

// Check username exists
$check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
if (mysqli_num_rows($check) > 0) {
    header("Location: register.php?error=Username already exists");
    exit;
}

// Password hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Upload profile picture
$profile_picture = "";
if (!empty($_FILES['profile_picture']['name'])) {
    $folder = "uploads/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
    $profile_picture = time() . "_" . $_FILES['profile_picture']['name'];
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $folder . $profile_picture);
}

// Insert
$sql = "INSERT INTO users 
(first_name, last_name, sex, username, password, phone, email, profile_picture, user_type)
VALUES
('$first_name','$last_name','$sex','$username','$hashed_password','$phone','$email','$profile_picture','$user_type')";

if (mysqli_query($conn, $sql)) {
    header("Location: register.php?msg=Registration successful");
} else {
    header("Location: register.php?error=Database error");
}
?>
