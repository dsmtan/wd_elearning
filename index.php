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
    // $testObj->createUser("C", "CC", "@C", "ccc"); // fname, lname, email, passw - creates new user every reload
    // $testObj->updateUser("5", "firstName", "D"); // updates column value by userid
    // $testObj->deleteUser(7); // deletes user by userid
    // $testObj->getSingleUser(2); // userID, gets data from 1 user by userid
    // $testObj->getAllUsers(); // gets data from all users

    // ----- BOOKMARKS ----- //
    $testBM = new Bookmark();
    // $testBM->createBookmark(3, 2002); // userID, segmentID
    // $testBM->deleteBookmark(2, 2010); // userID, segmentID
    // $testBM->getBookmarks(1); // userID, gets all bookmarks of user

    // ----- USER PROGRESS ----- //
    $testProgress = new UserProgress();
    // $testProgress->getModuleProgress(2, 1001); // userID, moduleID 
    // $testProgress->createModuleProgress(4, 1001); // userID, moduleID 
    // $testProgress->completeModule(2, 1001); // userID, moduleID
    // $testProgress->unlockModule(2, 1001); // userID, moduleID

    // $testProgress->getSegmentProgress(1, 2002); // userID, segmentID 
    // $testProgress->createSegmentProgress(1, 2003); // userID, segmentID
    // $testProgress->completeSegment(1, 2002); // userID, segmentID

    // $testProgress->getTestResult(3, 4002); // userID, testID
    // $testProgress->calculateTestScore(1, 4002); // userID, testID, calculates testScore by correct answers
    // $testProgress->addTestResult(2, 4002, 50); // userID, testID, testScore at end of test

    // $testProgress->getTestAnswer(1, 5006); // userID, questionID
    // $testProgress->addTestAnswer(1, 5007, false); // userID, questionID, answeredCorrect boolean


    // ----- ACHIEVEMENT ----- //
    $testAchievement = new Achievement();
    // $testAchievement->addUserAchievement(2, 9005); // userID, achievementID, by trigger
    // $testAchievement->getUserAchievements(6); // get all user achievements by userid
    // $testAchievement->getAllAchievements(); // get all existing achievements
    // $testAchievement->getAchievement(9003); // achievementID, get 1 existing achievement


    // ----- LEARNING CONTENT ----- //
    $testModule = new Module();
    // $testModule->getAllModules();
    // $testModule->getModuleTitle(1003);

    $testSegment = new Segment();
    // $testSegment->getAllSegments();
    // $testSegment->getSegmentContent(2002); //segmentID
    // $testSegment->getSegmentExercise(2001); //segmentID

    $testModuleTest = new ModuleTest();
    // $testModuleTest->getAllTests();
    // $testModuleTest->getTestQuestions(4003); //testID gets all 5 questions
    // $testModuleTest->getSingleQuestion(5009); //questionID gets 1 question


    ?>

</body>

</html>