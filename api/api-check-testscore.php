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
$testScore = $progress->calculateTestScore($userID, $testID);
$progress->addTestResult($userID, $testID, $testScore);
$completedModules = count($progress->getCompletedModulesByUser($userID));
$allModulesCompleted = $completedModules == count($allModules) ? true : false;

if (!$isLastModule && $testScore > 79) {
    $nextModule = strval($moduleID + 1);
    $progress->completeModule($userID, $moduleID);
    $progress->unlockModule($userID, $nextModule);
    $progress->completeAllSegments($userID, $moduleID); // in case user skipped exercise
    header("Location: ../moduletest.php?id=$moduleID&testid=$testID&testscore=$testScore&result=completed");
    exit();
}

if ($isLastModule && $testScore > 79 && $allModulesCompleted) { // entire course is finished
    $progress->completeModule($userID, $moduleID);
    $progress->completeAllSegments($userID, $moduleID); // in case user skipped exercise
    header("Location: ../moduletest.php?id=$moduleID&testid=$testID&testscore=$testScore&result=finished");
    exit();
}

header("Location: ../moduletest.php?id=$moduleID&testid=$testID&testscore=$testScore&result=failed");
