<?php
session_start();
include "config/db.php";

/* Hubin admin */
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit;
}

/* Hubin ID */
if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit;
}

$id = (int) $_GET['id'];

/* Ka hortag admin is-delete */
if ($id === $_SESSION['user_id']) {
    header("Location: manage_users.php?error=You cannot delete your own account");
    exit;
}

/* Hubin user jiro */
$check = mysqli_query($conn, "SELECT id FROM users WHERE id=$id");
if (mysqli_num_rows($check) !== 1) {
    header("Location: manage_users.php?error=User not found");
    exit;
}

/* Delete user */
mysqli_query($conn, "DELETE FROM users WHERE id=$id");

/* Redirect */
header("Location: manage_users.php?success=User deleted successfully");
exit;
