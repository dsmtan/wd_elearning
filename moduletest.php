<?php
session_start();
include 'includes/autoloader.php';

$userID = $_SESSION['userID'];
$testID = $_GET['testid'];

require 'components/moduleOverview.php';

$test = new ModuleTest();
$testQuestions = $test->getTestQuestions($testID);

$achPopupHTML = '';
$scriptAnimation = '';

if (!isset($_GET['result'])) {
    $questionID = isset($_GET['qid']) ? $_GET['qid'] : $testQuestions[0]->questionID;
    $key = array_search($questionID, array_column($testQuestions, 'questionID'));

    $qNumber = $key + 1;
    $question = $testQuestions[$key];
    $questionContent = $question->questionContent;

    $optionsArray = [$question->choiceA, $question->choiceB, $question->choiceC, $question->choiceD];
    $optionsHTML = '';

    foreach ($optionsArray as $i => $option) {
        $i = $i + 1;
        $checked = $i === 1 ? 'checked' : ''; // first option selected by default
        $optionsHTML .=
            "<input class='input--options' type='radio' name='questionAnswer' value='$option' id='option-$i'  $checked>
        <label class='label--options' for='option-$i'>
        $option
        </label>";
    }

    $isLastQuestion = count($testQuestions) === $qNumber ? true : false;
    $buttonText = $isLastQuestion ? 'FINISH TEST' : 'Next question';

    $testContentHTML = "
        <h2>TEST TIME!</h2>
        <h3>Question $qNumber / 5</h3>
        <p>$questionContent</p>
        <form id='formAnswerOptions' class=' form--answerOptions' action='api/api-check-testanswer.php?moduleid=$moduleID&testid=$testID&qid=$questionID' method='POST'>
            $optionsHTML
            <button type='submit'>$buttonText</button>
        </form>";
} else {
    $result = $_GET['result'];
    $testScore = $_GET['testscore'];
    $correctAnswers = $testScore / 100 * count($testQuestions);

    switch ($result) {
        case 'completed':
            $nextModule = $moduleID + 1;
            $testContentHTML = "
            <div class='div--testResult'>
                <h2>CONGRATULATIONS!</h2>
                <p>You passed the test and scored</p>
                <p class='p--score'>$correctAnswers/5 CORRECT</p>
                <div id='i_robot_happy'></div>
                <p>Keep up the good work!</p>
                <a href ='module.php?id=$nextModule'><button>Continue to the next module</button></a>
            </div>";
            $scriptAnimation .=  "initHappyRobot()";
            break;
        case 'finished':
            $testContentHTML = "
            <div class='div--testResult'>
                <h2>CONGRATULATIONS!</h2>
                <p>You passed the LAST test and scored</p>
                <p class='p--score'>$correctAnswers/5 CORRECT!</p>
                <div id='i_robot_happy'></div>
                <p class='p--finished'>Amazing, you've completed the WHOLE COURSE!</p>           
            </div>";
            $scriptAnimation .=  "initHappyRobot()";
            break;
        default:
            $testContentHTML = "
            <div class='div--testResult'>
                <h2>Oh no...</h2>
                <p>Sorry, you failed the test and scored</p>
                <p class='p--score'>$correctAnswers/5 CORRECT</p>
                <div id='i_robot_sad'></div>
                <a href ='moduletest.php?id=$moduleID&testid=$testID'><button>Let's try again</button></a>
            </div>";
            $scriptAnimation .=  "initSadRobot()";
    }

    // check for new achievements
    $achievement = new Achievement();
    $userAchievements = $achievement->getUserAchievements($userID);

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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="main--testWrapper">
        <?php
        require_once('components/navigation.php');
        ?>

        <section class="section--testContent">
            <article class="art--testContent">
                <?= $testContentHTML ?>
                <div class="div--achNotifications">
                    <?= $achPopupHTML ?>
                </div>
            </article>
            <?= $moduleOverview ?>
        </section>

    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
    <script src="js/moduleTest.js"></script>
    <script>
        <?= $scriptAnimation ?>
    </script>
</body>

</html>