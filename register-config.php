<?php
session_start();

include("database.php");

$registrationMessage = "";

if (isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //Registration validation
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
        $registrationMessage = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $registrationMessage = "Invalid email format.";
    } elseif (strlen($password) < 6) {
        $registrationMessage = "Password must be at least 6 characters long.";
    } elseif ($password !== $confirm_password) {
        $registrationMessage = "Passwords do not match.";
    } else {
        $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
        $email_check_result = $conn->query($email_check_sql);

        if ($email_check_result->num_rows > 0) {
            $registrationMessage = "Email already exists. Please use a different email.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);   //hash

            $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['registration_success'] = true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
header("Location: signin.php");
exit(); 
?>