<?php
include 'includes/autoloader.php';
session_start();

$moduleID = $_GET['id'];
$userID = $_SESSION['userID'];

$segment = new Segment();
$segmentsByModule = $segment->getSegmentsByModule($moduleID);

$segmentID = isset($_GET['segid']) ? $_GET['segid'] : $segmentsByModule[0]->segmentID;
$segContent = $segment->getSegmentContent($segmentID);
$segExercise = $segment->getSegmentExercise($segmentID);

$bookmark = new Bookmark();
$isBookmarked = $bookmark->getSingleBookmark($userID, $segmentID);
$bookmarkedClass = $isBookmarked ? 'bookmarked' : '';
$bookmarkIcon = file_get_contents('assets/ico_bookmark_flat.svg');
$bookmarkButton = "<div id='divBookmarkBtn' class='div--bookmarkBtn $bookmarkedClass' onclick='toggleBookmark($userID, $segmentID)'><p>Save for later</p> $bookmarkIcon </div>";




// TO DO
// media: check file type + render based on file type


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="main--moduleWrapper">
        <?php
        require_once('components/navigation.php');
        ?>

        <section class="section--moduleContent">
            <article class="art--segmentContent">
                <?= $bookmarkButton ?>
                <h2><?= $segContent->title ?></h2>
                <p><?= $segContent->explanation ?></p>

                <h3>Media (to do)</h3>
                <div class="div--exerciseContent">
                    <h3>Exercise</h3>
                    <p><?= $segExercise->exerciseContent ?></p>
                    <form id="form--exercise" action="api/api-check-exercise.php" onsubmit="return false">
                        <textarea name="exerciseAnswer" placeholder="Type your answer here.."></textarea>
                        <button type="submit" onclick="checkExAnswer(<?= $segExercise->exerciseID ?>, <?= $segmentID ?>)">Check your answer</button>
                        <div id="exFeedback" class="div--feedback">Feedback</div>
                    </form>
                </div>
            </article>
            <article class="art--previousNext">
                <button>Previous</button>
                <button>Next</button>
            </article>
            <?php
            require_once('components/moduleOverview.php');
            ?>

        </section>

    </main>
    <script src="js/module.js"></script>
</body>

</html>