<?php

include '../includes/autoloader.php';
session_start();

if (!empty($_POST['userEmail']) && !empty($_POST['userPassword'])) {
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

    $user = new User();
    $loginUser = $user->findUserByEmail($userEmail); // check if user account exists
    var_dump($loginUser);

    if (!$loginUser) {
        $_SESSION['errorMessage'] = 'There\'s no account for this email. Sign up first.';
        header('Location: ../login.php');
        exit();
    }

    if (
        $loginUser && $userPassword != $loginUser->password
    ) {
        $_SESSION['errorMessage'] = 'Your password is incorrect. Try again.';
        header('Location: ../login.php');
        exit();
    }

    if (
        $loginUser && $userPassword == $loginUser->password
    ) {
        $_SESSION['userID'] = $loginUser->userID;
        unset($_SESSION['errorMessage']);
        header('Location: ../index.php');
        exit();
    }
}
$_SESSION['errorMessage'] = 'Please fill in both fields. Try again.';
header('Location: ../login.php');
