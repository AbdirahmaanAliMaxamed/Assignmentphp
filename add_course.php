<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);

    if (empty($course_code) || empty($course_name)) {
        $error = "All fields are required";
    } else {
        $sql = "INSERT INTO courses (course_code, course_name)
                VALUES ('$course_code','$course_name')";
        if (mysqli_query($conn, $sql)) {
            header("Location: manage_courses.php");
            exit;
        } else {
            $error = "Course code already exists";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Add New Course</h2>
<a href="manage_courses.php">⬅ Back</a><br><br>

<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    <label>Course Code</label><br>
    <input type="text" name="course_code" required><br><br>

    <label>Course Name</label><br>
    <input type="text" name="course_name" required><br><br>

    <button type="submit" name="submit">Save</button>
</form>

</body>
</html>
