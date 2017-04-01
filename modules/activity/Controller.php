<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace modules\activity;

use core\Model;
use core\Controller as CoreController;
use modules\activity\Method as activity;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->activity = $method;
    }

    protected function index(): void
    {
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('obj', $this->activity->all());
        $view->setVar('content', 'modules/activity/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function api(): void
    {
        $this->priv([99, 1]);
        $obj = $this->activity->api();
        die($obj);
    }
    protected function json(): void
    {
        $obj = $this->activity->all();
        foreach ($obj as $i => $v) {
            unset($obj[$i]->content);
            $obj[$i]->description = strip_tags($obj[$i]->description);
            $maxLength = 10;
            if (strlen($obj[$i]->description) > $maxLength + 2) {
                $obj[$i]->description = mb_substr($obj[$i]->description, 0, $maxLength, 'UTF-8').'...';
            }
        }
        $obj = json_encode($obj, JSON_UNESCAPED_UNICODE);
        die($obj);
    }
    protected function add(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('content', 'modules/activity/templates/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAdd(): void
    {
        $this->priv([99, 1]);
        $name = $this->postQuery('name');
        $url = $this->postQuery('url');
        $description = $this->postQuery('description');
        $this->activity->add($name, $url, $description);
        $this->redirectTo('index.php?mod=activity');
    }
    protected function update(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('obj', $this->activity->show($id));
        $view->setVar('content', 'modules/activity/templates/update.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doUpdate(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $name = $this->postQuery('name');
        $url = $this->postQuery('url');
        $description = $this->postQuery('description');
        $this->activity->update($id, $name, $url, $description);
        $this->redirectTo('index.php?mod=activity');
    }
    protected function delete(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $id = $this->getQuery('id');
        $view->setVar('obj', $this->activity->show($id));
        $view->setVar('content', 'modules/activity/templates/delete.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doDelete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->activity->delete($id);
        $this->redirectTo('index.php?mod=activity');
    }
    public function __destruct()
    {
    }
}
