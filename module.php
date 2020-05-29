<?php
include 'includes/autoloader.php';
session_start();

$moduleID = $_GET['id'];

$segment = new Segment();
$segmentsByModule = $segment->getSegmentsByModule($moduleID);

$segmentID = isset($_GET['segid']) ? $_GET['segid'] : $segmentsByModule[0]->segmentID;
$segContent = $segment->getSegmentContent($segmentID);
$segExercise = $segment->getSegmentExercise($segmentID);

// TO DO
// media: check file type + render based on file type
// exercise

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="main--moduleWrapper">
        <?php
        require_once('components/navigation.php');
        ?>

        <section class="section--moduleContent">
            <article class="art--segmentContent">
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