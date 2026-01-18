<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn,
    "SELECT courseworks.*, courses.course_name
     FROM courseworks
     JOIN courses ON courseworks.course_id = courses.id
     ORDER BY courseworks.id DESC"
);
?>
<!DOCTYPE html>
<html>
<head><title>Manage Courseworks</title>
<link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Manage Courseworks</h2>
<a href="dashboard_admin.php">⬅ Back to Dashboard</a>
 |
<a href="add_coursework.php">➕ Add Coursework</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Course</th>
    <th>Title</th>
    <th>Due Date</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['course_name']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['due_date']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td>
        <a href="edit_coursework.php?id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="delete_coursework.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Delete this coursework?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>
</body>
</html>
