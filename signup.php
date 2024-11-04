<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstantUI | SignIn</title>
    <link rel="stylesheet" href="./style/register.css">
</head>

<body>
    <?php include "navbar.php" ?>

    <?php

    include 'connection.php';

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $pass = password_hash($password, PASSWORD_BCRYPT);
        $emailQuery = " select * from user_table where email = '$email' ";
        $query = mysqli_query($con, $emailQuery);
        $emailcount = mysqli_num_rows($query);

        if ($emailcount > 0) {

            echo "Email Alredy Exist !!!";
        } else {

            $insertQuery = " insert into user_table( name, email, password) values('$name', '$email', '$pass' ) ";
            $iquery = mysqli_query($con, $insertQuery);

            if ($iquery) {
    ?>
                <script>
                    alert('Data Inserted Succesfully.');
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Error !!!");
                </script>
    <?php
            }
        }
    }

    ?>

    <div class="container">
        <div class="form-box">
            <form class="form" method="post">
                <span class="title">Sign up</span>
                <span class="subtitle">Create a free account with your email.</span>
                <div class="form-container">
                    <input type="text" class="input" name="name" placeholder="Name">
                    <input type="email" class="input" name="email" placeholder="Email">
                    <input type="password" class="input" name="password" placeholder="Password">
                </div>
                <button type="submit" name="submit">Sign up</button>
            </form>
            <div class="form-section">
                <p>Have an account? <a href="login.php">Log in</a> </p>
            </div>
        </div>
    </div>
</body>

</html>