<?php

// needs userID, moduleID and $testID

$segmentsByModule = $progress->getSegmentProgressByModule($userID, $moduleID);
$totalSegInModule = count($segmentsByModule) + 1; // + 1 is for the test
$completedSegInModule = [];

foreach ($segmentsByModule as $segment) {
    if ($segment->completed == true) {
        array_push($completedSegInModule, $segment->segmentID);
    }
}

$testResult = $progress->getTestResult($userID, $testID);
if (!empty($testResult) && ($testResult->testScore > 79)) {
    array_push($completedSegInModule, $testID);
}

$progressInModule = round((count($completedSegInModule) / $totalSegInModule) * 100, 2);
