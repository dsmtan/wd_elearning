<?php
include 'includes/autoloader.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>

    <?php

    // ----- USERS ----- //
    $testObj = new User();
    // $testObj->createUser("A", "AA", "@A", "aaa"); // creates new user every reload
    // $testObj->updateUser("4", "firstName", "Denise"); // updates column value by userid
    // $testObj->deleteUser(5); // deletes user by userid
    // $testObj->getSingleUser(2); // gets data from 1 user by userid
    // $testObj->getAllUsers(); // gets data from all users

    // ----- BOOKMARKS ----- //
    $testBM = new Bookmark();
    // $testBM->createBookmark(1, 1018); // userID, segmentID
    // $testBM->deleteBookmark(1, 1018); // userID, segmentID

    // ----- USER PROGRESS ----- //
    $testProgress = new UserProgress();
    // $testProgress->createModuleProgress(2, 2208); // userID, moduleID 
    // $testProgress->completeModule(1, 2200); // userID, moduleID
    // $testProgress->unlockModule(1, 2203); // userID, moduleID
    // $testProgress->createSegmentProgress(1, 1108); // userID, segmentID
    // $testProgress->completeSegment(4, 1106); // userID, segmentID
    // $testProgress->addTestResult(5, 8821, 50); // userID, testID, testScore at end of test
    // $testProgress->addTestAnswer(2, 3020, true); // userID, questionID, answeredCorrect boolean

    // ----- ACHIEVEMENT ----- //
    $testAchievement = new UserAchievement();
    // $testAchievement->addAchievement(6, 800); // userID, achievementID by trigger
    // $testAchievement->getAchievements(6); // get all user achievements by userid


    ?>

</body>

</html>