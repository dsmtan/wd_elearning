<?php

// needs userID and moduleID

$segmentsByModule = $progress->getSegmentProgressByModule($userID, $moduleID);
$totalSegInModule = count($segmentsByModule);
$completedSegInModule = [];

foreach ($segmentsByModule as $segment) {
    if ($segment->completed == true) {
        array_push($completedSegInModule, $segment->segmentID);
    }
}

$progressInModule = round((count($completedSegInModule) / $totalSegInModule) * 100, 2);
