<?php

include '../includes/autoloader.php';

if (!isset($_POST['studentEmail'])) {
    exit();
}

$studentEmail = $_POST['studentEmail'];
$classRoomID = $_GET['classID'];

$classRoom = new ClassRoom();
$studentAdded = $classRoom->addStudentToClass($classRoomID, $studentEmail);

if ($studentAdded < 1) {
    $user = new User();
    $studentUser = $user->findUserByEmail($studentEmail);
    if ($studentUser) {
        if ($studentUser->teacherAccess == 0) {
            echo 'alreadyAdded';
            exit();
        } else {
            echo 'isTeacher';
            exit();
        }
    }
    echo 'failed';
    exit();
}

echo 'success';
