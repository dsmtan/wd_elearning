<?php

function calcModuleProgress($userID, $moduleID, $testID)
{
    $progress = new UserProgress();
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
    return $progressInModule;
}
