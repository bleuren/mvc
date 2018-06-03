<?php

ini_set('session.cookie_httponly', 1);
session_start();
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
if (!file_exists('config.php')) {
    copy('install/install.php', 'install.php');
    include 'install.php';
    die();
}
if (!isset($_SESSION['hash'])) {
    $_SESSION['hash'] = md5(!empty($_SERVER['HTTP_USER_AGENT']) || !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'] : 'wrong');
} elseif ($_SESSION['hash'] != md5(!empty($_SERVER['HTTP_USER_AGENT']) || !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'] : 'wrong')) {
    session_regenerate_id();
    $_SESSION = array();
    $_SESSION['hash'] = md5(!empty($_SERVER['HTTP_USER_AGENT']) || !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'] : 'wrong');
}
function differentUser()
{
    session_destroy();
}
function requireOnce(string $fileName)
{
    if (!defined($fileName)) {
        require $fileName;
        define($fileName, 1);
    }
}
requireOnce('config.php');
requireOnce('autoload.php');
$modules = scandir(APP_REAL_PATH.'/modules');
$module = isset($_GET['mod']) && in_array($_GET['mod'], $modules) ? $_GET['mod'] : 'home';
$method = 'modules\\'.$module.'\Method';
$controller = 'modules\\'.$module.'\Controller';
$controller = new $controller(new $method());
$controller->setRouter(new core\Router());
$controller->run();
echo '<!-- 網站設計 © 2017 DivStudio(任家輝,paste.ren@gmail.com) -->';
echo memory_get_usage();
