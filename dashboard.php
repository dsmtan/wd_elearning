<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

include 'includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="main--dashboardWrapper">
        <?php
        require_once('components/navigation.php');
        ?>

        <section class="section--dashboardContent">
            <article class="art--userIntro">
                <h3>Welcome<span id="spanIntroName"></span>!</h3>
                <p>You're doing great, keep up the good work!</p>
                <h4>Where you left off:</h4>
            </article>
            <article class="art--userPersonal">
                <h3>Personal information</h3>
                <form id="form--userInfo" class="form--personalInfo" action="" method="POST" onsubmit="return false">
                    <input id="inputUserFirst" name="firstName" type="text" placeholder="First name">
                    <input id="inputUserLast" name="lastName" type="text" placeholder="Last name">
                    <input id="inputUserEmail" name="email" type="text" placeholder="Email">
                    <input id="inputUserPassword" name="password" type="password" placeholder="Password">

                    <button onclick="updateUser()" type="submit" name="update-user">Update info</button>
                </form>

                <button id="btnDeleteUser" onclick="deleteUser()" name="delete-user">Delete account</button>
            </article>
            <article class="art--userProgress">
                <h3>Your progress</h3>
                <h3>Your achievements</h3>
            </article>
        </section>

    </main>

    <script src="js/dashboard.js"></script>

</body>

</html>