<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace modules\home;

use core\Model;
use core\Controller as CoreController;
use modules\home\Method as home;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->home = $method;
    }
    protected function index(): void
    {
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('module', 'article');
        $view->setVar('itemsPerPage', 10);
        $view->setVar('maxSize', 10);
        $view->setVar('content', 'modules/article/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function fileSystem(): void
    {
        $view = $this->view;
        $view->setVar('content', 'modules/home/templates/fileSystem.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function e(): void
    {
        $view = $this->view;
        $msg = $this->getQuery('m', 0);
        $view->setVar('msg', $msg);
        $view->setVar('content', 'modules/home/templates/error.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    public function __destruct()
    {
    }
}
