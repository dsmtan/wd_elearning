<?php
include 'includes/autoloader.php';


$msgBluePrint = '';

if (isset($_GET["errorMsg"])) {

    if ($_GET["errorMsg"] == "emptyFields") {
        $msgBluePrint .= '<div class="div--error"><p>You have empty fields</p></div>';
    } else if ($_GET["errorMsg"] == "invalidEmail") {
        $msgBluePrint .= '<div class="div--error"><p>Invalid Email</p></div>';
    } else if ($_GET["errorMsg"] == "invalidName") {
        $msgBluePrint .= '<div class="div--error"><p>Firstname and lastname should have 2 - 20 characters</p></div>';
    }
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


            <img src="images/logo_start.jpg" alt="logo">
            <h1>Welcome to Elearning Tool</h1>

            <form id="formSignupUser" action="api-signup.php" method="POST">
                <h3>Sign Up</h3>
                <input name=" firstName" type="text" placeholder="first name"><br>
                <input name="lastName" type="text" placeholder="last name"><br>
                <input name="email" type="text" placeholder="email"><br>
                <input name="password" type="password" placeholder="password"><br>
                <button type="submit" name="signup-submit">Sign Up</button>
                <div id="pErrorMsg"> <?= $msgBluePrint ?></div>
            </form>

            <p class="p--login">Already have an account? <a href="login.php">Log in</a></p>



        </div>

        <?php


        ?>


</body>

</html>