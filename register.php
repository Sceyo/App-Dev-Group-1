<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php
    if (isset($_POST["submit"])) {
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $emailAddress = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($firstName) || empty($lastName) || empty($emailAddress) || empty($password) || empty($confirmPassword)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password !== $confirmPassword) {
        array_push($errors, "Password does not match");
    }
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = '$emailAddress'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        array_push($errors, "Email already exists!");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class ='alert alert-danger'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $emailAddress, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully. </div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>
        <form action="register.php" method="post">
            <h2>Sign Up</h2>
            <br>
            <div class="form-group">
                <label for="firstname"><strong>First Name</strong></label>
                <input type="text" class="form-control" name="firstname" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lastname"><strong>Last Name</strong></label>
                <input type="text" class="form-control" name="lastname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password"><strong>Password</strong></label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="confirm_password"><strong>Confirm Password</strong></label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
            </div>
            <div class="form-button text-center">
                <input type="submit" class="btn btn-primary" value="Sign Up" name="submit">
            </div>
            <div class="copyright-notice">
            2023 © INTERASIAN REALTY SERVICES INC.
        </div>
        </form>
    </div>
</body>
</html>
