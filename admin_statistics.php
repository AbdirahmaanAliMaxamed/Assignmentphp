<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Total submissions
$total_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM coursework_submissions");
$total = mysqli_fetch_assoc($total_q)['total'];

// Pass count (grade NOT starting with F)
$pass_q = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS pass_count 
     FROM coursework_submissions 
     WHERE grade IS NOT NULL 
     AND grade NOT LIKE 'F%'"
);
$pass = mysqli_fetch_assoc($pass_q)['pass_count'];

// Fail count (grade starting with F)
$fail_q = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS fail_count 
     FROM coursework_submissions 
     WHERE grade LIKE 'F%'"
);
$fail = mysqli_fetch_assoc($fail_q)['fail_count'];

// Percentages
$pass_percent = ($total > 0) ? round(($pass / $total) * 100, 2) : 0;
$fail_percent = ($total > 0) ? round(($fail / $total) * 100, 2) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Statistics</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>📈 Coursework Statistics</h2>
<a href="dashboard_admin.php">⬅ Back to Dashboard</a>
<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>Metric</th>
    <th>Value</th>
</tr>
<tr>
    <td>Total Submissions</td>
    <td><?php echo $total; ?></td>
</tr>
<tr>
    <td>Passed</td>
    <td><?php echo $pass; ?> (<?php echo $pass_percent; ?>%)</td>
</tr>
<tr>
    <td>Failed</td>
    <td><?php echo $fail; ?> (<?php echo $fail_percent; ?>%)</td>
</tr>
</table>

</body>
</html>
