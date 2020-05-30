<?php

// needs userID

$segment = new Segment();
$totalSegments = count($segment->getAllSegments());

$progress = new UserProgress();
$completedSegments = count($progress->getCompletedSegmentsByUser($userID));
$courseProgress = round(($completedSegments / $totalSegments) * 100, 2);
