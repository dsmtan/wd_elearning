<?php

include '../includes/autoloader.php';



if (isset($_POST["login-submit"])) {

    if (empty($_POST["userEmail"]) || empty($_POST["userPassword"])) {
        header("Location: ../login.php?errorMsg=emptyFields");
        exit();
    }
    // else if (!filter_var($email, FILTER_VALIDATE_EMAIL )){
    //     header("Location: login.php?errorMsg=invalidEmail");
    //     exit();
    // }
    else {
        $loginUser = new User();
        $loginUser->loginUser($_POST["userEmail"]);
    }
} else {
    echo "error";
}
