<?php

include '../includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];

$user = new User();
$currentUser = $user->getSingleUser($userID);
echo json_encode($currentUser, JSON_PRETTY_PRINT);
