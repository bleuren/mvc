<?php

namespace modules\weeks;

use core\Model;
use core\Controller as CoreController;
use modules\weeks\Method as weeks;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->weeks = $method;
    }
    protected function index(): void
    {
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99]));
        $view->setVar('posts', $this->weeks->getAllPosts());
        $view->setVar('content', 'modules/weeks/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function add(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('content', 'modules/weeks/templates/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAdd(): void
    {
        $this->priv([99, 1]);
        $date = explode('-', $this->postQuery('date'));
        $file = $this->postQuery('fileToUpload');
        $this->weeks->add($date[0], $date[1], $date[2], $file, $author = $_SESSION['user']->id);
        $this->redirectTo('./index.php?mod=weeks');
    }
    protected function delete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $view = $this->view;
        $view->setVar('item', $this->weeks->show($id));
        $view->setVar('content', 'modules/weeks/templates/delete.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doDelete(): void
    {
        $this->priv([99, 1]);
        $this->weeks->delete($this->getQuery('id'));
        $this->redirectTo('./index.php?mod=weeks');
    }
    public function __destruct()
    {
    }
}
