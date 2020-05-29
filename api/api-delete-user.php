<?php

include '../includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];

$user = new User();
$deletedUser = $user->deleteUser($userID);
session_destroy();
header('Location: ../login.php');
