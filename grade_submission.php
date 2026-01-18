<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: view_submissions.php");
    exit;
}

$id = $_GET['id'];

// Fetch submission
$sql = "
SELECT 
    cs.*,
    u.first_name,
    u.last_name,
    c.course_name,
    cw.title
FROM coursework_submissions cs
JOIN users u ON cs.student_id = u.id
JOIN courseworks cw ON cs.coursework_id = cw.id
JOIN courses c ON cw.course_id = c.id
WHERE cs.id='$id'
LIMIT 1
";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

// Save grade
if (isset($_POST['save'])) {
    $grade = $_POST['grade'];
    $feedback = $_POST['feedback'];

    mysqli_query(
        $conn,
        "UPDATE coursework_submissions
         SET grade='$grade', feedback='$feedback', status='graded'
         WHERE id='$id'"
    );

    header("Location: view_submissions.php?msg=Coursework graded successfully");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grade Coursework</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>📝 Grade Coursework</h2>
<a href="view_submissions.php">⬅ Back</a>
<br><br>

<p><b>Student:</b> <?php echo $data['first_name']." ".$data['last_name']; ?></p>
<p><b>Course:</b> <?php echo $data['course_name']; ?></p>
<p><b>Coursework:</b> <?php echo $data['title']; ?></p>

<p>
<b>File:</b>
<a href="uploads/coursework_submissions/<?php echo $data['file_path']; ?>" target="_blank">
    📄 View Submission
</a>
</p>

<form method="POST">
    <label>Grade</label><br>
    <input type="text" name="grade" value="<?php echo $data['grade']; ?>" required><br><br>

    <label>Feedback</label><br>
    <textarea name="feedback" rows="5" cols="40"><?php echo $data['feedback']; ?></textarea><br><br>

    <button type="submit" name="save">Save Grade</button>
</form>

</body>
</html>
