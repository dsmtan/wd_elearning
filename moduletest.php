<?php
session_start();
include 'includes/autoloader.php';

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
            <?php
            require_once('components/moduleOverview.php');
            ?>

        </section>

    </main>

</body>

</html>