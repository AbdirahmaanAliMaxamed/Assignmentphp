<?php
session_start();
include "config/db.php";

// admin check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Courses</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Manage Courses</h2>
<a href="dashboard_admin.php">⬅ Back to Dashboard</a>
<br><br>

<a href="add_course.php">➕ Add New Course</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Course Code</th>
    <th>Course Name</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM courses ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['course_code']; ?></td>
    <td><?= $row['course_name']; ?></td>
    <td><?= $row['status']; ?></td>
    <td>
        <a href="edit_course.php?id=<?= $row['id']; ?>">Edit</a> |
        <a href="delete_course.php?id=<?= $row['id']; ?>"
           onclick="return confirm('Delete this course?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
