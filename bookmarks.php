<?php
include 'includes/autoloader.php';

session_start();
$userID = $_SESSION['userID'];

$getAllBookmarks = new Bookmark();
$getAllSegments = new Segment();
$getAllModules = new Module();

$allBookmarks = $getAllBookmarks->getBookmarks($userID);
$numberBookmarks = count($allBookmarks);

if ($numberBookmarks === 0){
    $noBookmarksHTMl .= "<h3>You have no bookmarks</h3> ";
} else {
    $bookmarkHTMl = "";

    foreach ($allBookmarks as $bookmark) {
        if ($numberBookmarks === "0"){
            $bookmarkHTMl .= "<h3>You have no bookmarks</h3> ";
        } else {
            $segmentID = $bookmark->segmentID;
            $segment = $getAllSegments->getSegmentContent($segmentID);
            $moduleID = $segment->moduleID;
            $moduleTitle = $getAllModules->getModuleTitle($moduleID);
            $moduleNumber = substr($moduleID, -2);
        
            $bookmarkHTMl .= "  
            <a href='module.php?id=$moduleID&segid=$segmentID'>
            <article>
            <div><h1>$segment->title</h1></div>
            <div><p>$moduleNumber $moduleTitle</p></div>
            </article>
            </a>
            ";
        }
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
        <?= $noBookmarksHTMl ?>
        <div class='section--bookmarksArticles'>
        <?= $bookmarkHTMl ?>
        </div>
        </section>

    </main>

</body>

</html>
