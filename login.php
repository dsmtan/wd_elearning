<?php
include 'includes/autoloader.php';

$errorMessage = '';
$errorClassName = '';
session_start();

if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    $errorClassName = "class='div--error'";
    echo $errorMessage;
    unset($_SESSION['errorMessage']);
}

if (isset($_SESSION['userID'])) {
    unset($_SESSION['errorMessage']);
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="div--login">
        <div class="leftdiv--login"></div>
        <div class="rightdiv--login">

            <!-- <img src="assets/logo_start.jpg" alt="logo"> -->
            <div id="i_logo"></div>
            <h1>Welcome!</h1>

            <form id="formLoginUser" action="api/api-login.php" method="POST">
                <h3>Log in</h3>
                <input id="userEmail" name="userEmail" type="text" placeholder="Email">
                <input id="userPassword" name="userPassword" type="password" placeholder="Password">
                <button type="submit">Log In</button>
            </form>
            <div <?= $errorClassName ?>>
                <p><?= $errorMessage ?></p>
            </div>

            <p class="p--login">Don't have an account? <a href="signup.php">Sign Up</a></p>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
            <script src="js/login.js"></script>
        </div>
</body>

</html>