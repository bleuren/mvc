<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace core;

use views\HtmlView;
use modules;

abstract class Controller
{
    abstract protected function index();
    protected $action = '';
    protected $router = null;
    public function setRouter(Router $router)
    {
        if (method_exists($this, $action = $router->getAction())) {
            $this->action = $action;
        } else {
            $this->action = 'index';
        }
    }
    final public function run(): void
    {
        $this->view = new HtmlView();
        $this->setToken();
        $this->users = new modules\users\Method();
        $this->setCommonVar();
        $this->{$this->action}();
    }
    private function setToken(): void
    {
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = array();
        }
        if ($this->action !== 'json') {
            $key = md5(microtime());
            array_push($_SESSION['csrf'], $key);
            $this->view->setVar('token', $key);
        }
    }
    private function setCommonVar(): void
    {
        $this->module = explode('\\', get_class($this))[1];
        $this->view->setVar('module', $this->module);
        $array = scandir(APP_REAL_PATH.'/modules');
        $lang = array();
        array_walk($this->setFile($array, function ($v) {
            return 'modules/'.$v.'/lang/'.LANG.'.php';
        }), function ($value, $key) use (&$lang) {
            include $value;
            $lang = array_merge($lang, $moduleLang);
        });
        $this->view->setVar('lang', $lang);
        $sidebar = $this->setFile($array, function ($v) {
            return 'modules/'.$v.'/templates/sidebar.tpl.php';
        });
        $this->view->setVar('module_menu', $sidebar);
        $array = ['links' => 'all', 'sidebar' => 'all', 'pages' => 'all'];
        array_walk($array, function ($value, $key) {
            $method = 'modules\\'.$key.'\\Method';
            $this->view->setVar($key, (new $method())->{$value}());
        });
    }
    private function &setFile(array $array, callable $callback): array
    {
        $map = array_map($callback, $array);
        $array = array_filter($map, function ($v) {
            return file_exists($v);
        });

        return $array;
    }
    public function priv(array $priv): bool
    {
        if ($result = in_array($_SESSION['user']->role ?? 0, $priv)) {
            return $result;
        } else {
            $this->redirectTo('index.php?mod=users');
            die;
        }

        return $result;
    }
    public function hasRole(array $role): bool
    {
        return in_array($_SESSION['user']->role ?? false, $role);
    }
    protected function redirectTo(string $url):void
    {
        header('Location: '.$url);
    }
    public static function getQuery(string $name, $default = null)
    {
        $content = $_GET[$name] ?? $default;
        if (is_array($content)) {
            $content = array_map(function ($v) {
                return htmlspecialchars($v);
            }, $content);
        } else {
            $content = htmlspecialchars($content);
        }

        return $content;
    }
    public static function postQuery(string $name, $default = null)
    {
        $content = $_POST[$name] ?? $default;
        if (is_array($content)) {
            $content = array_map(function ($v) {
                return htmlspecialchars($v);
            }, $content);
        } else {
            $content = htmlspecialchars($content);
        }

        return $content;
    }
    public static function session(string $name, $default = null)
    {
        if (isset($_SESSION[$name]) && is_array($_SESSION[$name])) {
            foreach ($_SESSION[$name] as $i => $v) {
                $content[$i] = $_SESSION[$name][$i] ?? $default;
            }
        } else {
            $content = $_SESSION[$name] ?? $default;
        }

        return $content;
    }
}
