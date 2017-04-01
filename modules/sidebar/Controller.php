<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace modules\sidebar;

use core\Model;
use core\Controller as CoreController;
use modules\sidebar\Method as sidebar;

class Controller extends CoreController
{
    public function __construct(Model $method)
    {
        $this->sidebar = $method;
    }
    protected function index(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('obj', $this->sidebar->all());
        $view->setVar('content', 'modules/sidebar/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function show(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('obj', $this->sidebar->show($id));
        $view->setVar('content', 'modules/sidebar/templates/show.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function add(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('content', 'modules/sidebar/templates/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function update(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('obj', $this->sidebar->show($id));
        $view->setVar('content', 'modules/sidebar/templates/update.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function delete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('id', $id);
        $view->setVar('content', 'modules/sidebar/templates/delete.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAdd(): void
    {
        $this->priv([99, 1]);
        $name = $this->postQuery('name');
        $url = $this->postQuery('url');
        $target = $this->postQuery('target');
        $this->sidebar->add($name, $url, $target);
        $this->redirectTo('index.php?mod=sidebar');
    }
    protected function doUpdate(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $name = $this->postQuery('name');
        $url = $this->postQuery('url');
        $target = $this->postQuery('target');
        $this->sidebar->update($id, $name, $url, $target);
        $this->redirectTo('index.php?mod=sidebar');
    }
    protected function doDelete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->sidebar->delete($id);
        $this->redirectTo('index.php?mod=sidebar');
    }
    public function __destruct()
    {
    }
}
