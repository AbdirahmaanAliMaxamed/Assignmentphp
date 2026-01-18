<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch submissions
$sql = "
SELECT 
    cs.id,
    cs.file_path,
    cs.submitted_at,
    cs.status,
    cs.grade,
    u.first_name,
    u.last_name,
    cw.title,
    c.course_name
FROM coursework_submissions cs
JOIN users u ON cs.student_id = u.id
JOIN courseworks cw ON cs.coursework_id = cw.id
JOIN courses c ON cw.course_id = c.id
ORDER BY cs.submitted_at DESC
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Submissions</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>📥 Coursework Submissions</h2>
<a href="dashboard_admin.php">⬅ Dashboard</a>
<br><br>

<?php
if (isset($_GET['msg'])) {
    echo "<p style='color:green'>".$_GET['msg']."</p>";
}
?>

<table border="1" cellpadding="8">
<tr>
    <th>Student</th>
    <th>Course</th>
    <th>Coursework</th>
    <th>File</th>
    <th>Status</th>
    <th>Grade</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
    <td><?php echo $row['course_name']; ?></td>
    <td><?php echo $row['title']; ?></td>

    <td>
        <a href="uploads/coursework_submissions/<?php echo $row['file_path']; ?>" target="_blank">
            📄 View
        </a>
    </td>

    <td>
        <?php echo ucfirst($row['status']); ?>
    </td>

    <td>
        <?php echo !empty($row['grade']) ? $row['grade'] : '-'; ?>
    </td>

    <td>
        <?php if ($row['status'] === 'graded') { ?>
            ✅ Graded
        <?php } else { ?>
            <a href="grade_submission.php?id=<?php echo $row['id']; ?>">
                📝 Grade
            </a>
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
