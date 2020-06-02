<?php

include '../includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];
$moduleID = $_GET['moduleid'];
$testID = $_GET['testid'];

$module = new Module();
$allModules = $module->getAllModules();
$isLastModule = $allModules[count($allModules) - 1]->moduleID == $moduleID ? true : false;

$progress = new UserProgress();
$testScore = $progress->handleTestSubmission($userID, $testID); // checks score and adds result to db

if (!$isLastModule && $testScore > 79) {
    $progress->handlePassedTest($userID, $moduleID, $isLastModule);
    header("Location: ../moduletest.php?id=$moduleID&testid=$testID&testscore=$testScore&result=completed");
    exit();
}

if ($isLastModule && $testScore > 79) { // entire course is finished
    $progress->handlePassedTest($userID, $moduleID, $isLastModule);
    header("Location: ../moduletest.php?id=$moduleID&testid=$testID&testscore=$testScore&result=finished");
    exit();
}

header("Location: ../moduletest.php?id=$moduleID&testid=$testID&testscore=$testScore&result=failed");
