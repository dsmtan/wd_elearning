<?php
$navOptions = array(
    'dashboard'  => array('text' => 'Dashboard',  'url' => 'dashboard.php'),
    'learning'  => array('text' => 'Learning',  'url' => 'index.php'),
    'bookmarks' => array('text' => 'Bookmarks', 'url' => 'bookmarks.php'),
);

$navLinks = "";
foreach ($navOptions as $option) {
    $navLinks .= "<a href='{$option['url']}'>{$option['text']}</a>\n";
}

$mainNavigation =   "<nav class='nav--main'>
                        <img src='assets/instalogo.png' class='img--logo'/>
                        <div class='div--navLinks'>
                        {$navLinks}
                        </div>
                    </nav>\n";

echo $mainNavigation;
