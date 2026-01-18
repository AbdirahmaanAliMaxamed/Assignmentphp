<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>User Registration</h2>

<?php
// Haddii fariin error ama success la soo diro
if (isset($_GET['msg'])) {
    echo "<p style='color:green'>" . htmlspecialchars($_GET['msg']) . "</p>";
}
if (isset($_GET['error'])) {
    echo "<p style='color:red'>" . htmlspecialchars($_GET['error']) . "</p>";
}
?>

<form action="register_process.php" method="POST" enctype="multipart/form-data">

    <label>First Name</label><br>
    <input type="text" name="first_name" required><br><br>

    <label>Last Name</label><br>
    <input type="text" name="last_name" required><br><br>

    <label>Sex</label><br>
    <select name="sex" required>
        <option value="">-- Select --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br><br>

    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>User Type</label><br>
    <select name="user_type" required>
        <option value="student">Student</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <label>Profile Picture</label><br>
    <input type="file" name="profile_picture" accept="image/*"><br><br>

    <button type="submit" name="submit">Register</button>
    <button type="reset">Reset</button>

</form>

</body>
</html>
