<?php

// TO DO:
// fix input icons

session_start();
$userID = $_SESSION['userID'];

include 'includes/autoloader.php';
include_once('includes/calc-course-progress.php');

$segment = new Segment();
$progress = new UserProgress();
$module = new Module();
$moduleTest = new ModuleTest();

$lastModule = $progress->getLatestModuleByUser($userID); // unlocked but not completed yet
if ($lastModule) {
    $lastModuleTitle = $module->getModuleTitle($lastModule->moduleID);
    $moduleNumber = substr($lastModule->moduleID, -2);
    $displayModuleHTML = "<p>$moduleNumber </p><p>$lastModuleTitle</p>";

    // progress in last left module
    $segmentsByModule = $progress->getSegmentProgressByModule($userID, $lastModule->moduleID);
    $totalSegInLast = count($segmentsByModule) + 1; // + 1 is for the test FIX ME: misses test below

    $completedSegInLast = [];
    foreach ($segmentsByModule as $segment) {
        if ($segment->completed == true) {
            array_push($completedSegInLast, $segment->segmentID);
        }
    }
    $progressLastModule = round((count($completedSegInLast) / $totalSegInLast) * 100, 2);

    // continue to left off link - default first seg
    $leftOffSegment = $segmentsByModule[0]->segmentID;
    $leftOffLink = "<a href='module.php?id=$lastModule->moduleID&segid=$leftOffSegment'>Continue where you left off last time.</a>";

    if (count($completedSegInLast) > 0) {
        if (count($completedSegInLast) < count($segmentsByModule)) {
            $leftOffSegment = $segmentsByModule[count($completedSegInLast)]->segmentID;
            $leftOffLink = "<a href='module.php?id=$lastModule->moduleID&segid=$leftOffSegment'>Continue where you left off last time.</a>";
        }

        if (count($completedSegInLast) == count($segmentsByModule)) {
            // user only needs to complete the test in last module
            $testID = $moduleTest->getTestByModule($lastModule->moduleID);
            $leftOffLink = "<a href='moduletest.php?id=$lastModule->moduleID&testid=$testID'>Continue where you left off last time.</a>";
        }
    }
} else { // course fully completed
    $leftOffLink = '';
    $allModules = $module->getAllModules();
    $finishedModuleID = $allModules[count($allModules) - 1]->moduleID;
    $moduleNumber = substr($finishedModuleID, -2);
    $displayModuleHTML = "<p>$moduleNumber </p><p>{$allModules[count($allModules) - 1]->title}</p>";

    $courseProgress = 100;
    $progressLastModule =  100;
}


// ACHIEVEMENTS

$achievement = new Achievement();
$allAchievements = $achievement->getAllAchievements();
$userAchievements = $achievement->getUserAchievements($userID);
$achievementsHTML = '';

foreach ($allAchievements as $ach) {
    $userAchExists = $achievement->getUserAchievement($userID, $ach->achievementID);
    $activateClass = $userAchExists ? 'activated' : '';
    $achievementsHTML .= "<div class='div--achievement $activateClass'>
                        <img src=$ach->imageURL />
                        <p>$ach->name</p>
                        </div>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="main--dashboardWrapper">
        <?php
        require_once('components/navigation.php');
        ?>

        <section class="section--dashboardContent">
            <article class="art--userIntro">
                <h3>Welcome<span id="spanIntroName"></span>!</h3>
                <p>You're doing great, keep up the good work!</p>
                <?= $leftOffLink ?>
            </article>
            <article class="art--userPersonal">
                <h3>Personal information</h3>
                <form id="form--userInfo" class="form--personalInfo" action="" method="POST" onsubmit="return false">
                    <input id="inputUserFirst" name="firstName" type="text" placeholder="First name">
                    <input id="inputUserLast" name="lastName" type="text" placeholder="Last name">
                    <input id="inputUserEmail" name="email" type="text" placeholder="Email">
                    <input id="inputUserPassword" name="password" type="password" placeholder="Password">
                    <button id="btnUpdateUser" onclick="updateUser()" type="submit" name="update-user">Update info</button>
                </form>
                <button id="btnDeleteUser" onclick="deleteUser()" name="delete-user">Delete account</button>
            </article>
            <article class="art--userProgress">
                <h3>Your progress</h3>
                <div class="div--moduleDisplay"><?= $displayModuleHTML ?></div>
                <h4>Last module progress</h4>
                <progress max="100" value="<?= $progressLastModule  ?>"></progress>
                <h4>Course progress</h4>
                <progress max="100" value="<?= $courseProgress ?>"></progress>

                <h3>Your achievements</h3>
                <div class="div--achvWrapper">
                    <?= $achievementsHTML ?>
                </div>
            </article>
        </section>

    </main>
    <script src="js/dashboard.js"></script>

</body>

</html>