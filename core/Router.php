<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright c 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace core;

class Router
{
    protected $action = 'index';
    public function __construct()
    {
        $this->action = isset($_GET['act']) && is_string($_GET['act']) ? strtolower($_GET['act']) : 'index';
    }
    public function getAction():string
    {
        return $this->action;
    }
}
