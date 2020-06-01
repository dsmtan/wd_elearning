<?php
session_start();
include '../includes/autoloader.php';

$userID = $_SESSION['userID'];
$moduleID = $_GET['moduleid'];
$testID = $_GET['testid'];
$questionID = $_GET['qid'];
$userAnswer = $_POST['questionAnswer'];

$test = new ModuleTest();
$allQuestions = $test->getTestQuestions($testID);
$question = $test->getSingleQuestion($questionID);
$correctAnswer = $question->correctAnswer;

$progress = new UserProgress();

if ($correctAnswer === $userAnswer) {
    $progress->addTestAnswer($userID, $questionID, true);
} else {
    $progress->addTestAnswer($userID, $questionID, false);
}

$nextQID = $questionID + 1;
// if last testquestion redirect to api-check-testscore
$nextLink = $allQuestions[count($allQuestions) - 1]->questionID === $questionID ? "api-check-testscore.php?moduleid=$moduleID&testid=$testID" : "../moduletest.php?id=$moduleID&testid=$testID&qid=$nextQID";

header("Location: $nextLink");
