<?php
session_start();

$timeout = 300; // 5 minutes

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout) {
    session_unset();
    session_destroy();
    header("Location: login.php?error=Session expired. Please login again");
    exit;
}

$_SESSION['LAST_ACTIVITY'] = time();

// Hubin: student
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Student Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['username']; ?></p>
<a href="student_courseworks.php">📌 View Courseworks</a>
<a href="logout.php">Logout</a>

</body>
</html>
