<?php
session_start();
include "config/db.php";

// Hubin student
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

// Fetch courseworks + submissions
$sql = "
SELECT 
    cw.id AS coursework_id,
    cw.title,
    cw.due_date,
    cw.status AS coursework_status,
    c.course_name,
    cs.status AS submission_status,
    cs.grade,
    cs.feedback
FROM courseworks cw
JOIN courses c ON cw.course_id = c.id
LEFT JOIN coursework_submissions cs 
    ON cw.id = cs.coursework_id 
    AND cs.student_id = '$student_id'
WHERE cw.status = 'active'
ORDER BY cw.due_date ASC
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Courseworks</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>🎓 My Courseworks</h2>
<a href="dashboard_student.php">⬅ Back to Dashboard</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>Course</th>
    <th>Title</th>
    <th>Due Date</th>
    <th>Status</th>
    <th>Grade</th>
    <th>Feedback</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['course_name']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['due_date']; ?></td>

    <td>
        <?php
        if ($row['submission_status'] == 'graded') {
            echo "Graded";
        } elseif ($row['submission_status'] == 'submitted') {
            echo "Submitted";
        } else {
            echo "Not Submitted";
        }
        ?>
    </td>

    <td>
        <?php echo $row['grade'] ?? "-"; ?>
    </td>

    <td>
        <?php echo $row['feedback'] ?? "-"; ?>
    </td>

    <td>
        <?php if ($row['submission_status'] == 'graded') { ?>
            ✅ Completed
        <?php } elseif ($row['submission_status'] == 'submitted') { ?>
            ⏳ Waiting for grading
        <?php } else { ?>
            <a href="submit_coursework.php?id=<?php echo $row['coursework_id']; ?>">
                📤 Submit
            </a>
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
