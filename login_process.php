<?php
session_start();
include "config/db.php";

// Hubi in form-ka la submit gareeyay
if (!isset($_POST['login'])) {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

// Validation
if (empty($username) || empty($password)) {
    header("Location: login.php?error=Please fill all fields");
    exit;
}

// Ka raadi user-ka database
$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {

    $user = mysqli_fetch_assoc($result);

    // Hubi user_status
    if ($user['user_status'] != 'active') {
        header("Location: login.php?error=Your account is blocked");
        exit;
    }

    // Hubi password
    if (password_verify($password, $user['password'])) {

        // Sessions
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['LAST_ACTIVITY'] = time();

        // Redirect ku xiran role
        if ($user['user_type'] == 'admin') {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_student.php");
        }
        exit;

    } else {
        header("Location: login.php?error=Invalid password");
        exit;
    }

} else {
    header("Location: login.php?error=User not found");
    exit;
}
?>
