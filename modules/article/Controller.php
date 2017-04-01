<?php

namespace modules\article;

use core\Model;
use core\Controller as CoreController;
use modules\article\Method as article;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->article = $method;
    }
    protected function index(): void
    {
        $view = $this->view;
        $group = $this->getQuery('group', 0);
        $view->setVar('group', $group);
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('itemsPerPage', 10);
        $view->setVar('maxSize', 10);
        $view->setVar('content', 'modules/'.$this->module.'/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function s(): void
    {
        die('constructing');
    }
    protected function json(): void
    {
        $group = $this->getQuery('group', 0);
        $obj = $this->{$this->module}->getAllitems($group);
        foreach ($obj as $i => $v) {
            unset($obj[$i]->group, $obj[$i]->content, $obj[$i]->file1, $obj[$i]->file2, $obj[$i]->file3, $obj[$i]->author);
        }
        $obj = json_encode($obj, JSON_UNESCAPED_UNICODE);
        die($obj);
    }
    protected function add(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('groups', $this->{$this->module}->allGroup());
        $view->setVar('content', 'modules/'.$this->module.'/templates/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAdd(): void
    {
        $this->priv([99, 1]);
        $data = ['group' => $this->postQuery('group'), 'category' => $this->postQuery('category'), 'title' => $this->postQuery('title'), 'content' => $this->postQuery('content'), 'file1' => $this->postQuery('fileToUpload1'), 'file2' => $this->postQuery('fileToUpload2'), 'file3' => $this->postQuery('fileToUpload3'), 'author' => $_SESSION['user']->id];
        $this->{$this->module}->add($data);
        $this->redirectTo('index.php?mod='.$this->module);
    }
    protected function show(): void
    {
        $id = $this->getQuery('id');
        $item = $this->{$this->module}->show($id);
        if (!$item) {
            $this->redirectTo('index.php?mod='.$this->module);
        }
        $item->author = $this->users->name($item->author);
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('item', $item);
        $view->setVar('content', 'modules/'.$this->module.'/templates/show.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function update(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $id = $this->getQuery('id');
        $view->setVar('item', $this->{$this->module}->show($id));
        $view->setVar('content', 'modules/'.$this->module.'/templates/update.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doUpdate(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $data = ['category' => $this->postQuery('category'), 'title' => $this->postQuery('title'), 'content' => $this->postQuery('content'), 'file1' => $this->postQuery('fileToUpload1'), 'file2' => $this->postQuery('fileToUpload2'), 'file3' => $this->postQuery('fileToUpload3'), 'author' => $_SESSION['user']->id];
        $this->{$this->module}->update($data, $id);
        $this->redirectTo('index.php?mod='.$this->module);
    }
    protected function delete(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('id', $this->getQuery('id'));
        $view->setVar('content', 'modules/'.$this->module.'/templates/delete.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doDelete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->{$this->module}->delete($id);
        $this->redirectTo('index.php?mod='.$this->module);
    }
    protected function group(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('groups', $this->{$this->module}->allGroup());
        $view->setVar('content', 'modules/'.$this->module.'/templates/group.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function addGroup(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('content', 'modules/'.$this->module.'/templates/addGroup.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function deleteGroup(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('group', $this->{$this->module}->showGroup($id));
        $view->setVar('content', 'modules/'.$this->module.'/templates/deleteGroup.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function updateGroup(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('group', $this->{$this->module}->showGroup($id));
        $view->setVar('content', 'modules/'.$this->module.'/templates/updateGroup.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAddGroup(): void
    {
        $this->priv([99, 1]);
        $name = $this->postQuery('name');
        $id = $this->{$this->module}->addGroup($name);
        $this->redirectTo('./index.php?mod='.$this->module.'&group='.$id);
    }
    protected function doUpdateGroup(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $name = $this->postQuery('name');
        $this->{$this->module}->updateGroup($name, $id);
        $this->redirectTo('./index.php?mod='.$this->module.'&act=group');
    }
    protected function doDeleteGroup(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->{$this->module}->deleteGroup($name, $id);
        $this->redirectTo('./index.php?mod='.$this->module.'&act=group');
    }
    public function __destruct()
    {
    }
}
