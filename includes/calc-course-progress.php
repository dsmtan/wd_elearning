<?php

// $userID = $_SESSION['userID']; should already be in file to export to.

$segment = new Segment();
$totalSegments = count($segment->getAllSegments());

$progress = new UserProgress();
$completedSegments = count($progress->getCompletedSegmentsByUser($userID));
$courseProgress = round(($completedSegments / $totalSegments) * 100, 2);
