<?php
session_start();

/* Hubinta admin login */
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- TOP BAR -->
<div class="topbar">
    <h2>Admin Dashboard</h2>
    <span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span>
</div>

<!-- MAIN LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a href="dashboard_admin.php">🏠 Dashboard</a>
        <a href="manage_users.php">👤 Manage Users</a>
        <a href="manage_courses.php">📚 Manage Courses</a>
        <a href="manage_courseworks.php">📝 Manage Courseworks</a>
        <a href="view_submissions.php">📥 View Submissions</a>
        <a href="admin_statistics.php">📈 Statistics</a>
        <a href="logout.php" class="logout">🚪 Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <h3>System Overview</h3>

        <div class="dashboard">

            <!-- USERS -->
            <div class="card">
                <a href="manage_users.php">
                    <h4>👤 Users</h4>
                    <p>Manage all system users</p>
                </a>
            </div>

            <!-- COURSES -->
            <div class="card">
                <a href="manage_courses.php">
                    <h4>📚 Courses</h4>
                    <p>Create & edit courses</p>
                </a>
            </div>

            <!-- COURSEWORK / SUBMISSIONS -->
            <div class="card">
                <a href="view_submissions.php">
                    <h4>📝 Coursework</h4>
                    <p>View student submissions</p>
                </a>
            </div>

            <!-- STATISTICS -->
            <div class="card">
                <a href="admin_statistics.php">
                    <h4>📈 Statistics</h4>
                    <p>Pass / Fail analysis</p>
                </a>
            </div>

            <!-- LOGOUT -->
            <div class="card">
                <a href="logout.php">
                    <h4>🚪 Logout</h4>
                    <p>You will be logged out</p>
                </a>
            </div>

        </div>

    </div>
</div>

</body>
</html>
