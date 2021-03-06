<?php

$dashboardIcon = file_get_contents('assets/ico_profile_regular.svg');
$learningIcon = file_get_contents('assets/ico_learning_regular.svg');
$bookmarkIcon = file_get_contents('assets/ico_bookmark_regular.svg');

$navOptions = array(
    'dashboard'  => array('name' => 'Dashboard', 'url' => 'dashboard.php', 'icon' => $dashboardIcon),
    'learning'  => array('name' => 'Learning', 'url' => 'index.php', 'icon' => $learningIcon),
    'bookmarks' => array('name' => 'Bookmarks', 'url' => 'bookmarks.php', 'icon' => $bookmarkIcon),
);

$urlPath = $_SERVER['REQUEST_URI'];
$navLinks = "";
$isModule = strpos(basename($urlPath), 'module.php') === 0;
$isTest = strpos(basename($urlPath), 'moduletest.php') === 0;
foreach ($navOptions as $option) {
    $currentClass = basename($urlPath) === $option['url'] || ($isModule || $isTest) && $option['url'] === 'index.php' ? "class='current'" : '';
    $navLinks .= "<a href='{$option['url']}' $currentClass>{$option['icon']}<span>{$option['name']}</span></a>";
}

$mainNavigation =   "<nav class='nav--main'>
                        <img src='assets/logo.svg' class='img--logo'/>
                        <div class='div--navLinks'>
                        {$navLinks}
                        </div>
                        <a class='a--logout' href='logout.php'>Log out</a>
                    </nav>";

echo $mainNavigation;
