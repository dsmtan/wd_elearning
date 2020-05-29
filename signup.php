<?php
include 'includes/autoloader.php';

$errorMessage = '';
$errorClassName = '';
session_start();

if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    $errorClassName = "class='div--error'";
    unset($_SESSION['errorMessage']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;900&display=swap" rel="stylesheet">
</head>

<body>


    <div class="div--signup">
        <div class="leftdiv--signup"></div>
        <div class="rightdiv--signup">

            <img src="assets/logo_start.jpg" alt="logo">
            <h1>Welcome!</h1>

            <form id="formSignupUser" action="api/api-signup.php" method="POST">
                <h3>Sign Up</h3>
                <input name=" firstName" type="text" placeholder="first name">
                <input name="lastName" type="text" placeholder="last name">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button type="submit" name="signup-submit">Sign Up</button>

            </form>

            <div <?= $errorClassName ?>>
                <p><?= $errorMessage ?></p>
            </div>
            <p class="p--login">Already have an account? <a href="login.php">Log in</a></p>

        </div>

</body>

</html>