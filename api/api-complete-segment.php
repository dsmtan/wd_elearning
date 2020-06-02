<?php

include '../includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];
$segmentID = $_GET['segID'];

$progress = new UserProgress();
$progress->completeSegment($userID, $segmentID);

// check for new achievements
$achievement = new Achievement();
$userAchievements = $achievement->getUserAchievements($userID);
$achPopupHTML = '';
foreach ($userAchievements as $userAch) {
    if ($userAch->unread == true) {
        // display notification
        $achData = $achievement->getAchievement($userAch->achievementID);
        $achPopupHTML .= "
            <div id='divAchPopup' class='div--achievedPopup'>
                <img src='$achData->imageURL' />
                <p>You've earned the badge:<br><span>$achData->name</span></p>
            </div>";
        $achievement->markReadUserAchievement($userID, $userAch->achievementID);
    }
}

echo $achPopupHTML;
