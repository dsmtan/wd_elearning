<?php
include 'includes/autoloader.php';
include 'includes/calc-module-progress.php';


session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}
$userID = $_SESSION['userID'];

$learningModule = new Module();
$allModules = $learningModule->getAllModules();
$modulesHTML = "";

foreach ($allModules as $module) {
    $moduleID = $module->moduleID;
    $moduleNumber = substr($moduleID, -2);
    $progress = new UserProgress();
    $moduleProgress = $progress->getModuleProgress($userID, $moduleID);
    switch ($moduleProgress->unlocked) {
        case '0':
            $linkStatusClass = 'not--active--link';
            $notactiveModuleClass = 'not--active--module';
            break;
        case '1':
            $linkStatusClass = '';
            $notactiveModuleClass = '';
            break;
        default:
            $linkStatusClass = '';
            $notactiveModuleClass = '';
    }

    $moduleTest = new ModuleTest();
    $testID = $moduleTest->getTestByModule($moduleID);

    $progressInModule = calcModuleProgress($userID, $moduleID, $testID);

    $modulesHTML .= "
    <div class='div--moduleStatus' id='info_module$moduleID'>
        <h3 class='white-text'>$moduleNumber $module->title</h3>
        <div class='index--progress'>
        <progress max='100' value='$progressInModule'></progress> 
        </div>
    </div>
    <a class='$linkStatusClass' href='module.php?id=$moduleID'><div class='$notactiveModuleClass' id='i_module$moduleID'></div></a>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <main class="main--indexWrapper">
        <?php
        require_once('components/navigation.php');
        ?>
        <section class="section--indexContent">
            <div id="module_illustrations">
                <?= $modulesHTML ?>
            </div>
            <div id="learning_path_illustration">
                <div id="background_path"></div>
            </div>
            <div class="index--background"></div>
        </section>
    </main>
    <script src="js/index.js"> </script>

</body>

</html>