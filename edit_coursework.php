<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: manage_courseworks.php");
    exit;
}

$id = (int)$_GET['id'];

// Hel coursework
$result = mysqli_query($conn, "SELECT * FROM courseworks WHERE id=$id");
$coursework = mysqli_fetch_assoc($result);

if (!$coursework) {
    header("Location: manage_courseworks.php");
    exit;
}

// Update
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE courseworks 
        SET title='$title',
            description='$description',
            due_date='$due_date',
            status='$status'
        WHERE id=$id
    ");

    header("Location: manage_courseworks.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Coursework</title>
</head>
<body>

<h2>Edit Coursework</h2>
<a href="manage_courseworks.php">⬅ Back</a><br><br>
<link rel="stylesheet" href="css/style.css">


<form method="POST">

    <label>Title</label><br>
    <input type="text" name="title"
           value="<?php echo htmlspecialchars($coursework['title']); ?>" required>
    <br><br>

    <label>Description</label><br>
    <textarea name="description"><?php echo htmlspecialchars($coursework['description']); ?></textarea>
    <br><br>

    <label>Due Date</label><br>
    <input type="date" name="due_date"
           value="<?php echo $coursework['due_date']; ?>">
    <br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="active" <?php if ($coursework['status']=='active') echo 'selected'; ?>>
            Active
        </option>
        <option value="inactive" <?php if ($coursework['status']=='inactive') echo 'selected'; ?>>
            Inactive
        </option>
    </select>
    <br><br>

    <button type="submit" name="update">Update</button>

</form>

</body>
</html>
