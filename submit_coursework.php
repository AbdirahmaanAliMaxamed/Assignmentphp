<?php
session_start();
include "config/db.php";

// Hubin student
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: student_courseworks.php");
    exit;
}

$coursework_id = $_GET['id'];
$student_id = $_SESSION['user_id'];

if (isset($_POST['upload'])) {

    if (!empty($_FILES['file']['name'])) {

        $folder = "uploads/coursework_submissions/";

        // Samee folder haddii uusan jirin
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES['file']['name']);
        $target = $folder . $file_name;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

            $sql = "INSERT INTO coursework_submissions
                    (student_id, coursework_id, file_path, submitted_at)
                    VALUES
                    ('$student_id', '$coursework_id', '$file_name', NOW())";

            mysqli_query($conn, $sql);

            header("Location: student_courseworks.php?msg=Coursework submitted successfully");
            exit;

        } else {
            $error = "Upload failed";
        }

    } else {
        $error = "Please choose a file";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Coursework</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>📤 Submit Coursework</h2>

<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Select File (PDF / DOC)</label><br><br>
    <input type="file" name="file" required><br><br>

    <button type="submit" name="upload">Upload</button>
</form>

<br>
<a href="student_courseworks.php">⬅ Back</a>

</body>
</html>
