<?php
include 'includes/autoloader.php';

$msgBluePrint = '';

if (isset($_GET["errorMsg"])) {
    if ($_GET["errorMsg"] == "emptyFields") {
        $msgBluePrint .= '<div class="div--error"><p>You have empty fields</p></div>';
    } else if ($_GET["errorMsg"] == "invalidEmail") {
        $msgBluePrint .= '<div class="div--error"><p>Invalid Email</p></div>';
    }
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

            <img src="images/logo_start.jpg" alt="logo">

            <h1>Welcome to Elearning Tool</h1>
            <form id="formLoginUser" action="api-login.php" method="POST">
                <h3>Log in</h3>
                <div>
                    <input id="userEmail" name="userEmail" type="text" placeholder="Email"></div>
                <div><input id="userPassword" name="userPassword" type="text" placeholder="Password"></div>
                <button type="submit" name="login-submit">Log In</button>
                <div id="pErrorMsg"> <?= $msgBluePrint ?></div>
            </form>


            <p class="p--login">Don't have an account? <a href="signup.php">Sign Up</a></p>


        </div>
</body>

</html>