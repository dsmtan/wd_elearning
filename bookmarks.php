<?php
include 'includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];

$getAllBookmarks = new Bookmark();
$getAllSegments = new Segment();
$getAllModules = new Module();

$allBookmarks = $getAllBookmarks->getBookmarks($userID);
$numberBookmarks = count($allBookmarks);
$bookmarkHTML = "";

if ($numberBookmarks === 0) {
    $bookmarkHTML .= "<h3>You have no bookmarks</h3> ";
} else {
    foreach ($allBookmarks as $bookmark) {
        $segmentID = $bookmark->segmentID;
        $segment = $getAllSegments->getSegmentContent($segmentID);
        $moduleID = $segment->moduleID;
        $moduleTitle = $getAllModules->getModuleTitle($moduleID);
        $moduleNumber = substr($moduleID, -2);

        $bookmarkHTML .= "  
            <a href='module.php?id=$moduleID&segid=$segmentID'>
            <article>
            <div><h1>$segment->title</h1></div>
            <div><p>$moduleNumber $moduleTitle</p></div>
            </article>
            </a>
            ";
        // }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="main--bookmarksWrapper">
        <?php
        require_once('components/navigation.php');
        ?>
        <section class="section--bookmarksContent">
            <h1>Bookmarks</h1>
            <div class='section--bookmarksArticles'>
                <?= $bookmarkHTML ?>
            </div>
        </section>

    </main>

</body>

</html>