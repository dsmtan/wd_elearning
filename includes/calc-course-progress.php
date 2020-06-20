<?php

// needs userID
$module = new Module();
$totalModules = count($module->getAllModules());

$segment = new Segment();
$totalCourseSteps = count($segment->getAllSegments()) + $totalModules;

$progress = new UserProgress();
$completedSegments = count($progress->getCompletedSegmentsByUser($userID));
$completedTests = count($progress->getPassedTestsByUser($userID));
$courseProgress = round((($completedSegments + $completedTests) / $totalCourseSteps) * 100, 2);
