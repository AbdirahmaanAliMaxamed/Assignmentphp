<?php
session_start();
include "config/db.php";

// Hubin admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Manage Users</h2>
<a href="dashboard_admin.php">⬅ Back to Dashboard</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Username</th>
    <th>User Type</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['user_type']; ?></td>
    <td><?php echo $row['user_status']; ?></td>
    <td>
        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a> |

        <?php if ($row['user_status'] == 'active') { ?>
            <a href="block_user.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Block this user?')">Block</a>
        <?php } else { ?>
            <a href="unblock_user.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Unblock this user?')">Unblock</a>
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
