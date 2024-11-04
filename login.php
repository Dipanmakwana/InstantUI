<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstantUI | Login</title>
    <link rel="stylesheet" href="./style/register.css">
</head>

<body>
    <?php include "navbar.php" ?>

    <?php

    include 'connection.php';

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $emailSearch = "select * from user_table where email = '$email' ";
        $query = mysqli_query($con, $emailSearch);

        $email_count = mysqli_num_rows($query);

        if ($email_count) {
            $email_pass = mysqli_fetch_assoc($query);
            $dbpass = $email_pass['password'];
            $password_decode = password_verify($password, $dbpass);

            if ($password_decode) {
                $_SESSION['name'] = $email_pass['name'];
                $_SESSION['user_email'] = $email;
                header('location:index.php');
            } else {
    ?>
                <script>
                    alert('Invalid Password');
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Email is not valid !!!");
            </script>
    <?php
        }
    }

    ?>
    <div class="container">
        <div class="form-box">
            <form class="form" method="post">
                <span class="title">Login</span>
                <span class="subtitle">Get started with our app, just start section and enjoy experience.</span>
                <div class="form-container">
                    <input type="email" name="email" class="input" placeholder="Email">
                    <input type="password" name="password" class="input" placeholder="Password">
                </div>
                <button type="submit" name="submit">Login</button>
            </form>
            <div class="form-section">
                <p>Don't have an account? <a href="signup.php">Sign up</a> </p>
            </div>
        </div>
    </div>
</body>

</html>