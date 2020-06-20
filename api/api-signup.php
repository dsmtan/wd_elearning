<?php

require '../includes/autoloader.php';
session_start();



$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];

// check if empty fields validation
if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
    $_SESSION['errorMessage'] = 'You didn\'t fill in all fields.';
    header('Location: ../signup.php');
    exit();
}
//  firstname validation
if (strlen($firstName) < 2 || strlen($firstName) > 30) {
    $_SESSION['errorMessage'] = 'First name should be between 2 and 30 characters.';
    header('Location: ../signup.php');
    exit();
}
//lastname validation
if (strlen($lastName) < 2 || strlen($lastName) > 30) {
    $_SESSION['errorMessage'] = 'Last name should be between 2 and 30 characters.';
    header('Location: ../signup.php');
    exit();
}
// email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errorMessage'] = 'Not a valid email.';
    header('Location: ../signup.php');
    exit();
}

// check if user already exists with same email
$newUser = new User();
$userExists = $newUser->findUserByEmail($email);

if ($userExists) {
    $_SESSION['errorMessage'] = 'This email is already used.';
    header('Location: ../signup.php');
    exit();
}

$newUserID = $newUser->createUser($firstName, $lastName, $email, $password); // creates user and returns id

// CREATE USER PROGRESS TRACKING
$module = new Module();
$modulesArray = $module->getAllModules();
foreach ($modulesArray as $key => $module) {
    $unlocked = $key === 0 ? true : false; // only first module is unlocked
    $userProgress = new UserProgress();
    $userProgress->createModuleProgress($newUserID, $module->moduleID, $unlocked);

    $segment = new Segment();
    $segmentsByModule = $segment->getSegmentsByModule($module->moduleID);
    foreach ($segmentsByModule as $segment) {
        $userProgress->createSegmentProgress($newUserID, $segment->segmentID);
    }
}

header('Location: ../login.php');
exit();
