<?php

$dashboardIcon = file_get_contents('assets/ico_profile_regular.svg');
$learningIcon = file_get_contents('assets/ico_learning_regular.svg');
$bookmarkIcon = file_get_contents('assets/ico_bookmark_regular.svg');

$navOptions = array(
    'dashboard'  => array('url' => 'dashboard.php', 'icon' => $dashboardIcon),
    'learning'  => array('url' => 'index.php', 'icon' => $learningIcon),
    'bookmarks' => array('url' => 'bookmarks.php', 'icon' => $bookmarkIcon),
);

$urlPath = $_SERVER['REQUEST_URI'];
$navLinks = "";
$isModule = strpos(basename($urlPath), 'module.php') === 0;
$isTest = strpos(basename($urlPath), 'moduletest.php') === 0;
foreach ($navOptions as $option) {
    $currentClass = basename($urlPath) === $option['url'] || ($isModule || $isTest) && $option['url'] === 'index.php' ? "class='current'" : '';
    $navLinks .= "<a href='{$option['url']}' $currentClass>{$option['icon']}</a>";
}

$mainNavigation =   "<nav class='nav--main'>
                        <img src='assets/logo.svg' class='img--logo'/>
                        <div class='div--navLinks'>
                        {$navLinks}
                        </div>
                    </nav>";

echo $mainNavigation;
