<?php

include '../includes/autoloader.php';

$studentID = $_GET['studentID'];
$classRoomID = $_GET['classID'];

$classRoom = new ClassRoom();
$studentRemoved = $classRoom->removeStudentFromClass($classRoomID, $studentID);

if ($studentRemoved < 1) {
    echo 'failed';
    exit();
}

echo 'success';
