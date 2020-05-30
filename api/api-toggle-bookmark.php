<?php

include '../includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];
$segmentID = $_GET['segID'];

$bookmark = new Bookmark();
$bookmarkExists = $bookmark->getSingleBookmark($userID, $segmentID);

if ($bookmarkExists) {
    $bookmark->deleteBookmark($userID, $segmentID);
    echo 'deleted';
    exit();
} else {
    $bookmark->createBookmark($userID, $segmentID);
    echo 'created';
}
