<?php

include '../includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];
$segmentID = $_GET['segID'];

$progress = new UserProgress();
$progress->completeSegment($userID, $segmentID);
