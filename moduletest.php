<?php
session_start();
include 'includes/autoloader.php';

require_once('components/moduleOverview.php');

$lastSegIDOfModule = $segmentsByModule[count($segmentsByModule) - 1]->segmentID;

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
                <h2>Time to test your knowledge!</h2>
                <p>blabla add test questions</p>

            </article>
            <article class="art--previousNext">
                <a href="module.php?id=<?= $moduleID ?>&segid=<?= $lastSegIDOfModule ?>"><button>Previous</button></a>
            </article>
            <?= $moduleOverview ?>

        </section>

    </main>

</body>

</html>