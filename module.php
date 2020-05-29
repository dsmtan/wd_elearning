<?php
include 'includes/autoloader.php';
session_start();

$moduleID = $_GET['id'];

$segment = new Segment();
$segmentsByModule = $segment->getSegmentsByModule($moduleID);

$segmentID = isset($_GET['segid']) ? $_GET['segid'] : $segmentsByModule[0]->segmentID;
$segContent = $segment->getSegmentContent($segmentID);

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

                <h3>Exercise (to do)</h3>
            </article>
            <?php
            require_once('components/moduleOverview.php');
            ?>

        </section>

    </main>

</body>

</html>