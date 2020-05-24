<?php
spl_autoload_register('classAutoLoader');

function classAutoLoader($className)
{
    $urlPath = $_SERVER['REQUEST_URI'];
    $isAPI = strpos(basename($urlPath), 'api') === 0;
    $path = $isAPI ? "../classes/" : "classes/";
    $extension = '.php';
    $fullPath = $path . $className . $extension;

    if (!file_exists($fullPath)) {
        return false;
    }

    include_once $fullPath;
}
