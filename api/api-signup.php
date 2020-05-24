<?php

require '../includes/autoloader.php';

if (isset($_POST["signup-submit"])) {

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // check if empty fields validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        header("Location: ../signup.php?errorMsg=emptyFields");
        exit();
    }
    // email validation
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?errorMsg=invalidEmail");
        exit();
    }
    //  firstname validation
    else if (strlen($firstName) < 2 || strlen($firstName) > 20) {
        header("Location: ../signup.php?errorMsg=invalidName");
        exit();
    }
    //lastname validation
    else if (strlen($lastName) < 2 || strlen($lastName) > 20) {
        header("Location: ../signup.php?errorMsg=invalidName");
        exit();
    } else {
        $newUser = new User();
        $newUser->createUser($firstName, $lastName, $email, $password);
        // change to admin + session start with stored userID
        header('Location: ../signup.php');
        exit();
    }
}
