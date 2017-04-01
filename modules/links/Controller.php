<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace modules\links;

use core\Model;
use core\Controller as CoreController;
use modules\links\Method as links;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->links = $method;
    }
    protected function index(): void
    {
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('obj', $this->links->all());
        $view->setVar('content', 'modules/links/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function add(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('content', 'modules/links/templates/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAdd(): void
    {
        $this->priv([99, 1]);
        $name = $this->postQuery('name');
        $url = $this->postQuery('url');
        $logo = $this->postQuery('logo');
        $this->links->add($name, $url, $logo);
        $this->redirectTo('index.php?mod=links');
    }
    protected function update(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('obj', $this->links->show($id));
        $view->setVar('content', 'modules/links/templates/update.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doUpdate(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $name = $this->postQuery('name');
        $url = $this->postQuery('url');
        $logo = $this->postQuery('logo');
        $this->links->update($id, $name, $url, $logo);
        $this->redirectTo('index.php?mod=links');
    }
    protected function delete(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $id = $this->getQuery('id');
        $view->setVar('obj', $this->links->show($id));
        $view->setVar('content', 'modules/links/templates/delete.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doDelete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->links->delete($id);
        $this->redirectTo('index.php?mod=links');
    }
    public function __destruct()
    {
    }
}
