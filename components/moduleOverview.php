<?php

$urlPath = $_SERVER['REQUEST_URI'];
$moduleID = $_GET['id'];

$module = new Module();
$moduleTitle = $module->getModuleTitle($moduleID);

$segment = new Segment();
$segmentsByModule = $segment->getAllSegments($moduleID);

$moduleTest = new ModuleTest();
$testID = $moduleTest->getTestByModule($moduleID);

$segmentOverview = "";
foreach ($segmentsByModule as $seg) {
    $segmentOverview .= "<div><a href='module.php?id={$moduleID}&segid={$seg->segmentID}' >$seg->title</a></div>";
}
$segmentOverview .= "<div><a href='moduletest.php?id={$moduleID}&testid={$testID}' >Test</a></div>";

$moduleOverview = "
    <article class='art--moduleOverview'>
        <div>
            <h1>{$moduleTitle}</h1>
        </div>
        <div>
            {$segmentOverview}
        </div>
        <div>Progress (do later)</div>
    </article>";

echo $moduleOverview;
