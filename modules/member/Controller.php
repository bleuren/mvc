<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace modules\member;

use core\Model;
use core\Controller as CoreController;
use modules\member\Method as member;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->member = $method;
    }
    protected function index(): void
    {
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('obj', $this->member->all());
        $view->setVar('content', 'modules/member/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function json(): void
    {
        $query_string = $this->getQuery('query');
        $query = $this->member->parse_query($query_string);
        if ($query['mod'] === 'member') {
            $data = $this->{$query['mod']}->{$query['act']}($query['id']);
            $output = array('#main' => $data->content);
        } else {
            $this->redirectTo($query_string);
        }
        die(json_encode($output));
    }
    protected function add(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('content', 'modules/member/templates/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function delete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('obj', $this->member->show($id));
        $view->setVar('content', 'modules/member/templates/delete.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function update(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('obj', $this->member->show($id));
        $view->setVar('content', 'modules/member/templates/update.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function show(): void
    {
        $id = $this->getQuery('id');
        $obj = $this->member->show($id);
        if ($obj === false) {
            $this->redirectTo('index.php?mod=member');
        }
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('obj', $obj);
        $view->setVar('content', 'modules/member/templates/show.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAdd(): void
    {
        $this->priv([99, 1]);
        $category = $this->postQuery('category');
        $title = $this->postQuery('title');
        $name = $this->postQuery('name');
        $phone = $this->postQuery('phone');
        $email = $this->postQuery('email');
        $work = $this->postQuery('work');
        $photo = $this->postQuery('photo');
        $this->member->add($category, $title, $name, $photo, $phone, $email, $work);
        $this->redirectTo('index.php?mod=member');
    }
    protected function doDelele(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->member->delete($id);
        $this->redirectTo('index.php?mod=member');
    }
    protected function doUpdate(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $category = $this->postQuery('category');
        $title = $this->postQuery('title');
        $name = $this->postQuery('name');
        $phone = $this->postQuery('phone');
        $email = $this->postQuery('email');
        $work = $this->postQuery('work');
        $photo = $this->postQuery('photo');
        $this->member->update($id, $category, $title, $name, $photo, $phone, $email, $work);
        $this->redirectTo('index.php?mod=member');
    }
    public function __destruct()
    {
    }
}
