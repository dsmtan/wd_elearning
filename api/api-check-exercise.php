<?php

include '../includes/autoloader.php';

$exerciseID = $_GET['exID'];
$userAnswer = trim($_POST['exerciseAnswer']);

$segment = new Segment();
$exercise = $segment->getExerciseByID($exerciseID);

if (strtolower($exercise->correctAnswer) == strtolower($userAnswer)) {
    echo 'correct';
    exit();
};

echo 'incorrect.';
