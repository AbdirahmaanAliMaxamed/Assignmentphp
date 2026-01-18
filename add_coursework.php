<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch courses
$courses = mysqli_query($conn, "SELECT * FROM courses WHERE status='active'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Coursework</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Add Coursework</h2>
<a href="manage_courseworks.php">⬅ Back</a><br><br>

<form method="POST" action="add_coursework_process.php">

<label>Course</label><br>
<select name="course_id" required>
    <option value="">-- Select Course --</option>
    <?php while ($c = mysqli_fetch_assoc($courses)) { ?>
        <option value="<?php echo $c['id']; ?>">
            <?php echo $c['course_name']; ?>
        </option>
    <?php } ?>
</select><br><br>

<label>Title</label><br>
<input type="text" name="title" required><br><br>

<label>Description</label><br>
<textarea name="description"></textarea><br><br>

<label>Due Date</label><br>
<input type="date" name="due_date"><br><br>

<button type="submit" name="save">Save</button>

</form>
</body>
</html>
