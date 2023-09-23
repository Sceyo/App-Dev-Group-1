<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href=".\css\style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $emailAddress = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$emailAddress'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if(password_verify($password, $user["password"])) {
                    header("Location: index.php"); //USER DASHBOARD
                    die();
                }else {
                    echo "<div class='alert alert-danger'>Password does not match!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match!</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <h2>Login</h2>
            <br>
            <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email:">
            </div>
            <div class="form-group">
                <label for="password"><strong>Password</strong></label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password:">
            </div>
            <div class="form-group text-center">
                Forget your password? <br> No worries, click <a href="reset_password.php">here</a> to reset your
                password.
            </div>
            <div class="form-button text-center">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
            </div>
        </form>
        <div class="copyright-notice">
            2023 © INTERASIAN REALTY SERVICES INC.
        </div>
    </div>
</body>

</html>