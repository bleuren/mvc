<?php

namespace modules\pages;

use core\Model;
use core\Controller as CoreController;
use modules\pages\Method as pages;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->pages = $method;
    }
    protected function index(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $id = $this->getQuery('id', 0);
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('items', $this->pages->all());
        $view->setVar('content', 'modules/pages/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function json(): void
    {
        $query_string = $this->getQuery('query');
        $query = $this->pages->parse_query($query_string);
        if ($query === false) {
            die('error!');
        }
        if (isset($query['act'])) {
            $data = $this->{$query['mod']}->{$query['act']}($query['id']);
            $output = array('#main' => $data->content);
        } else {
            $data = $this->{$query['mod']}->all();
            $output = array('#main' => $data);
        }
        die(json_encode($output));
    }
    protected function itemSort(): void
    {
        $this->priv([99, 1]);
        $query_string = $this->postQuery('query');
        $query = json_decode(htmlspecialchars_decode($query_string));
        foreach ($query[0] as $i => $v) {
            if (isset($v->children[0])) {
                $child = $v->children[0];
                $child = array_filter($child, function ($v) {
                    return $v->display !== 0;
                });
                $child = array_map(function ($v) {
                    return $v->id;
                }, $child);
                $this->pages->itemSort($child);
            }
        }
        $query = array_filter($query[0], function ($v) {
            return $v->display !== 0;
        });
        $query = array_map(function ($v) {
            return $v->id;
        }, $query);
        $this->pages->itemSort($query);
        die($query_string);
    }
    protected function show(): void
    {
        $id = $this->getQuery('id');
        $obj = $this->pages->show($id);
        if ($obj === false) {
            $this->redirectTo('index.php');
        }
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99, 1]));
        $view->setVar('page', $obj);
        $view->setVar('content', 'modules/pages/templates/show.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function update(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $id = $this->getQuery('id');
        $view->setVar('obj', $this->pages->show($id));
        $view->setVar('content', 'modules/pages/templates/update.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doUpdate(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $name = $this->postQuery('name', 0);
        $url = $this->postQuery('url', 0);
        $content = $this->postQuery('content', 0);
        $display = $this->postQuery('display', 0);
        $this->pages->upd($id, $name, $content, $url, $_SESSION['user']->id, $display);
        $this->redirectTo('./index.php?mod=pages');
    }
    protected function delete(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('id', $this->getQuery('id'));
        $view->setVar('content', 'modules/pages/templates/delete.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doDelete(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->pages->delete($id);
        $this->redirectTo('./index.php?mod=pages');
    }
    protected function add(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $view->setVar('items', $this->pages->all());
        $view->setVar('content', 'modules/pages/templates/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAdd(): void
    {
        $this->priv([99, 1]);
        $category = $this->postQuery('category', 0);
        $name = $this->postQuery('name', 0);
        $url = $this->postQuery('url', 0);
        $content = $this->postQuery('content', 0);
        $display = $this->postQuery('display', 0);
        $this->pages->add($category, $name, $content, $url, $_SESSION['user']->id, $display);
        $this->redirectTo('./index.php?mod=pages');
    }
    public function __destruct()
    {
    }
}
