<?php

include '../includes/autoloader.php';

$exerciseID = $_GET['exID'];
$userAnswer = trim($_POST['exerciseAnswer']);

$segment = new Segment();
$exercise = $segment->getExerciseByID($exerciseID);

if ($exercise->correctAnswer == $userAnswer) {
    echo 'correct';
    exit();
};

echo 'incorrect.';
