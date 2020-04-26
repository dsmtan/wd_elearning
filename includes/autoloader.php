<?php
spl_autoload_register('classAutoLoader');

function classAutoLoader($className)
{
    $path = "classes/";
    $extension = '.php';
    $fullPath = $path . $className . $extension;

    if (!file_exists($fullPath)) {
        return false;
    }

    include_once $fullPath;
}
