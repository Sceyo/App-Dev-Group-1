<?php
session_start(); 

if (isset($_SESSION['registration_success']) && $_SESSION['registration_success']) {
    $registrationMessage = "Account created! Proceed to Sign In";
    unset($_SESSION['registration_success']);  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login</title>
    <link rel="stylesheet" href=".\css\login-register.css">
    <style>
    .registration-message {
        color: black;
    }
    </style>
</head>

<body class="form-v8">
    <div class="page-content" style="background-image: url(assets/signin-bg.jpg);">
        <div class="form-v8-content">
            <div class="form-left">
                <img src=".\assets\logowithname.jpg" alt="form"
                    style="width: 494px; height: 620px; transform: scale(0.65,0.5);">
            </div>
            <div class="form-right" style="margin-left: 2em;">
                <div class="tab">
                    <div class="tab-inner">
                        <button class="tablinks" onclick="openCity(event, 'sign-up')" id="defaultOpen">Sign Up</button>
                    </div>
                    <div class="tab-inner">
                        <button class="tablinks" onclick="openCity(event, 'sign-in')">Sign In</button>
                    </div>
                </div>
                <form class="form-detail" action="register-config.php" method="post">
                    <div class="tabcontent" id="sign-up">
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" name="firstname" id="firstname" class="input-text" required>
                                <span class="label">First Name</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" name="lastname" id="lastname" class="input-text" required>
                                <span class="label">Last Name</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" name="email" id="email" class="input-text" required>
                                <span class="label">E-Mail</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="password" name="password" id="password" class="input-text" required>
                                <span class="label">Password</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="password" name="confirm_password" id="confirm_password" class="input-text"
                                    required>
                                <span class="label">Confirm Password</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <?php if (!empty($registrationMessage)) { ?>
                        <div class="registration-message"><?php echo $registrationMessage; ?></div>
                        <?php } ?>
                        <div class="form-row-last">
                            <input type="submit" name="register" class="register" value="Register">
                        </div>
                    </div>
                </form>

                <!----Sign in------->
                <form class="form-detail" action="login-config.php" method="post">
                    <div class="tabcontent" id="sign-in">
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" name="email-login" id="email-login" class="input-text" required>
                                <span class="label">E-Mail</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="password" name="password-login" id="email-login" class="input-text"
                                    required>
                                <span class="label">Password</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row-last">
                            <input type="submit" name="login" class="register" value="Sign In">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
    </script>
</body>

</html>