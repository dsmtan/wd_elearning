<?php

include '../includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];

if (!isset($_POST['firstName']) || !isset($_POST['lastName']) ||  !isset($_POST['email']) || !isset($_POST['password'])) {
    exit();
}

$user = new User();
$currentUser = $user->getSingleUser($userID);

$currentUser->firstName = $_POST['firstName'];
$currentUser->lastName = $_POST['lastName'];
$currentUser->email = $_POST['email'];
$currentUser->password = $_POST['password'];

$user->updateUser($userID, $currentUser);

echo json_encode($currentUser, JSON_PRETTY_PRINT);
