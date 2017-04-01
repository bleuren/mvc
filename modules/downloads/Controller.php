<?php

namespace modules\downloads;

use core\Model;
use core\Controller as CoreController;
use modules\downloads\Method as downloads;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->downloads = $method;
    }

    protected function index(): void
    {
        $view = $this->view;
        $gid = $this->getQuery('group', 0);
        $files = $this->downloads->getAlldownloads($gid);
        foreach ($files as $i => $v) {
            $files[$i]->author = $this->users->name($v->author);
        }
        $group = $this->downloads->showGroup($gid);
        $view->setVar('group', $group);
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('files', $files);
        $view->setVar('content', 'modules/downloads/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function group(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('groups', $this->downloads->allGroup());
        $view->setVar('content', 'modules/downloads/templates/group.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function add(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('groups', $this->downloads->allGroup());
        $view->setVar('content', 'modules/downloads/templates/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function delete(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('item', $this->downloads->show($this->getQuery('id')));
        $view->setVar('content', 'modules/downloads/templates/delete.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function addGroup(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('content', 'modules/downloads/templates/addGroup.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function deleteGroup(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('group', $this->downloads->showGroup($id));
        $view->setVar('content', 'modules/downloads/templates/deleteGroup.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function updateGroup(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('group', $this->downloads->showGroup($id));
        $view->setVar('content', 'modules/downloads/templates/updateGroup.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAdd(): void
    {
        $this->priv([99, 1]);
        $group = $this->postQuery('group');
        $name = $this->postQuery('name');
        $file = $this->postQuery('fileToUpload');
        $this->downloads->add($group, $name, $file, $_SESSION['user']->id);
        $this->redirectTo('./index.php?mod=downloads');
    }
    protected function doDelete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->downloads->delete($id);
        $this->redirectTo('./index.php?mod=downloads');
    }
    protected function doAddGroup(): void
    {
        $this->priv([99, 1]);
        $name = $this->postQuery('name');
        $id = $this->downloads->addGroup($name);
        $this->redirectTo('./index.php?mod=downloads&group='.$id);
    }
    protected function doUpdateGroup(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $name = $this->postQuery('name');
        $this->downloads->updateGroup($name, $id);
        $this->redirectTo('./index.php?mod=downloads&act=group');
    }
    protected function doDeleteGroup(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->downloads->deleteGroup($id);
        $this->redirectTo('./index.php?mod=downloads&act=group');
    }
    public function __destruct()
    {
    }
}
