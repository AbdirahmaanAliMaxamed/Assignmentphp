<?php
session_start();
include "config/db.php";

/* Hubin admin */
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

/* Hel course ID */
if (!isset($_GET['id'])) {
    header("Location: manage_courses.php");
    exit;
}

$id = (int)$_GET['id'];

/* Soo qaado course */
$result = mysqli_query($conn, "SELECT * FROM courses WHERE id=$id");
if (mysqli_num_rows($result) != 1) {
    header("Location: manage_courses.php");
    exit;
}
$course = mysqli_fetch_assoc($result);

/* Update marka la submit gareeyo */
if (isset($_POST['update'])) {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);
    $status      = $_POST['status'];

    if ($course_code == "" || $course_name == "") {
        $error = "All fields are required";
    } else {
        $update = mysqli_query(
            $conn,
            "UPDATE courses 
             SET course_code='$course_code',
                 course_name='$course_name',
                 status='$status'
             WHERE id=$id"
        );

        if ($update) {
            header("Location: manage_courses.php?msg=Course updated successfully");
            exit;
        } else {
            $error = "Update failed";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Edit Course</h2>
<a href="manage_courses.php">⬅ Back</a>
<br><br>

<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="post">

    <label>Course Code</label><br>
    <input type="text" name="course_code"
           value="<?php echo htmlspecialchars($course['course_code']); ?>" required>
    <br><br>

    <label>Course Name</label><br>
    <input type="text" name="course_name"
           value="<?php echo htmlspecialchars($course['course_name']); ?>" required>
    <br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="active" <?php if ($course['status']=='active') echo 'selected'; ?>>
            Active
        </option>
        <option value="inactive" <?php if ($course['status']=='inactive') echo 'selected'; ?>>
            Inactive
        </option>
    </select>
    <br><br>

    <button type="submit" name="update">Update</button>

</form>

</body>
</html>
