<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstantUI | Upload</title>
    <link rel="stylesheet" href="./style/upload.css">
</head>

<body>
    <?php include "navbar.php" ?>

    <?php
    include 'connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_email'])) {
        $html_code = mysqli_real_escape_string($con, $_POST['html_code']);
        $css_code = mysqli_real_escape_string($con, $_POST['css_code']);
        $email = $_SESSION['user_email'];

        $query = "INSERT INTO component_table (html_code, css_code, email) VALUES ('$html_code', '$css_code', '$email')";

        if (!mysqli_query($con, $query)) {
            echo "Error: " . mysqli_error($con);
        }
        mysqli_close($con);
    }
    ?>


    <div class="container">
        <div class="form-container">
            <h1>Upload Your Element here</h1>
            <form class="form" method="POST">
                <div class="form-group">
                    <label for="html_code">Upload your HTML code here</label>
                    <textarea name="html_code" id="html_code" rows="10" cols="50" required=""></textarea>
                </div>
                <div class="form-group">
                    <label for="css_code">Upload your CSS code here</label>
                    <textarea name="css_code" id="css_code" rows="10" cols="50" required=""></textarea>
                </div>
                <button class="form-submit-btn" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/0a16c6e09c.js" crossorigin="anonymous"></script>
</body>

</html>