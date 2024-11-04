<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstantUI</title>
    <link rel="stylesheet" href="./style/navbar.css">
</head>

<body>
    <nav>
        <div class="logo">Instant <span>UI</span></div>
        <div class="pages">
            <li><a href="index.php">Home</a></li>
            <li><a href="components.php">Browse Components</a></li>

            <?php if (isset($_SESSION['user_email'])): ?>
                <li><a href="upload.php">Upload</a></li>
                <a href="logout.php">
                    <button class="login-button">Logout</button>
                </a>
            <?php else: ?>
                <a href="login.php">
                    <button class="login-button">Login</button>
                </a> |
                <a href="signup.php">
                    <button class="sign-up-button">Sign up</button>
                </a>
            <?php endif; ?>
        </div>
    </nav>
</body>

</html>