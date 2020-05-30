<?php

$userID = $_SESSION['userID'];
$urlPath = $_SERVER['REQUEST_URI'];
$moduleID = $_GET['id'];

$isTest = strpos(basename($urlPath), 'moduletest.php') === 0;

$moduleTest = new ModuleTest();
$testID = $moduleTest->getTestByModule($moduleID);

include_once('includes/calc-course-progress.php');
include_once('includes/calc-module-progress.php');

$module = new Module();
$moduleTitle = $module->getModuleTitle($moduleID);

$segment = new Segment();
$segmentsByModule = $segment->getSegmentsByModule($moduleID);

$moduleNumber = substr($moduleID, -2);
$displayModuleHTML = "<p>$moduleNumber</p><p>$moduleTitle</p>";

$segmentOverview = "";
foreach ($segmentsByModule as $seg) {
    $currentSeg = !$isTest && $segmentID == $seg->segmentID ? 'current' : '';
    $segmentOverview .= "<a href='module.php?id=$moduleID&segid=$seg->segmentID' ><div class='div--segBtn $currentSeg'>$seg->title</div></a>";
}
$currentTest = $isTest ? 'current' : '';
$segmentOverview .= "<a href='moduletest.php?id=$moduleID&testid=$testID' ><div class='div--segBtn $currentTest'>Test</div></a>";

$moduleOverview = "
    <article id='moduleOverview' class='art--moduleOverview'>
        <div class='div--moduleDisplay'>
            $displayModuleHTML
        </div>    
        <div class='div--segLinks'>
            $segmentOverview
        </div>
        <div class='div--progressDisplay'>
            <p>Module progress</p>
            <progress max='100' value='$progressInModule'></progress>
            <p>Course progress</p>
            <progress max='100' value='$courseProgress'></progress>
        </div>
    </article>";

echo $moduleOverview;
