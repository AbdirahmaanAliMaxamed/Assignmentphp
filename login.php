<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-center">
    <div class="login-box">

        <h2 class="login-title">🔐 User Login</h2>
        <p class="login-subtitle">Welcome back! Please login to continue</p>

        <form action="login_process.php" method="POST">

            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter your username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" name="login" class="login-btn">
                Login
            </button>

        </form>

        <p class="signup-text">
            Don’t have an account?
            <a href="register.php">Sign up</a>
        </p>

    </div>
</div>

</body>
</html>
