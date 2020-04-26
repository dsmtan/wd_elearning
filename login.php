<?php
include 'includes/autoloader.php';

// check if existing user
// check password
// if correct login: userID should be stored in session

if (isset($_POST['userLogin']) && isset($_POST['userPassword'])) {

    // below should be fetched from database
    $sCorrectEmail = 'd@d.com';
    $sCorrectPassword = 'qwerty';
    $sCorrectName = "Denise";

    $sUserLogin = $_POST['userLogin'];
    $sUserPassword = $_POST['userPassword'];

    if (
        $sUserLogin == $sCorrectEmail &&
        $sUserPassword == $sCorrectPassword
    ) {
        session_start();
        $_SESSION['userLogin'] = $sUserLogin;
        $_SESSION['userName'] = $sCorrectName;
        header('Location: admin.php');
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>

<body>

    <form id="formLoginUser" action="" method="POST">
        <h3>Log in</h3>
        <input id="inputUser" name="userLogin" type="text" placeholder="email">
        <input id="inputPassword" name="userPassword" type="text" placeholder="password">
        <button>LOG IN</button>
        <p class="pErrorMsg">Error message placeholder</p>
    </form>

</body>

</html>