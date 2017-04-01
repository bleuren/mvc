<?php

$include_path = array();
$include_path[] = get_include_path();
$include_path[] = APP_REAL_PATH;
$include_path[] = APP_REAL_PATH.'/libs';
set_include_path(implode(PATH_SEPARATOR, $include_path));
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';
    requireOnce($fileName);
}
spl_autoload_register('autoload');
