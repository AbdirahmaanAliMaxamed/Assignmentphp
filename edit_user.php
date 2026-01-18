<?php
session_start();
include "config/db.php";

/* Hubin admin */
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

/* Hubin ID */
if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit;
}

$id = (int) $_GET['id'];

/* Hel xogta user-ka */
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
if (mysqli_num_rows($result) != 1) {
    header("Location: manage_users.php");
    exit;
}

$user = mysqli_fetch_assoc($result);

/* Update */
if (isset($_POST['update'])) {

    $first_name  = trim($_POST['first_name']);
    $last_name   = trim($_POST['last_name']);
    $username    = trim($_POST['username']);
    $user_status = $_POST['user_status'];

    if (empty($first_name) || empty($last_name) || empty($username)) {
        $error = "All fields are required";
    } else {

        $update = "UPDATE users SET 
                    first_name='$first_name',
                    last_name='$last_name',
                    username='$username',
                    user_status='$user_status'
                   WHERE id=$id";

        if (mysqli_query($conn, $update)) {
            header("Location: manage_users.php");
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
    <title>Edit User</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Edit User</h2>
<a href="manage_users.php">⬅ Back</a>
<br><br>

<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="post">

    <label>First Name</label><br>
    <input type="text" name="first_name" 
           value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
    <br><br>

    <label>Last Name</label><br>
    <input type="text" name="last_name" 
           value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
    <br><br>

    <label>Username</label><br>
    <input type="text" name="username" 
           value="<?php echo htmlspecialchars($user['username']); ?>" required>
    <br><br>

    <label>Status</label><br>
    <select name="user_status">
        <option value="active" <?php echo ($user['user_status'] == 'active') ? 'selected' : ''; ?>>
            Active
        </option>
        <option value="not active" <?php echo ($user['user_status'] == 'not active') ? 'selected' : ''; ?>>
            Blocked
        </option>
    </select>
    <br><br>

    <button type="submit" name="update">Update User</button>

</form>

</body>
</html>
