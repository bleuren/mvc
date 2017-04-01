<?php

namespace views;

use core\View;

class HtmlView extends View
{
    public function fetch()
    {
        $args = func_get_args();
        $template_filename = $args[0];
        $html = '';
        ob_start();
        include $template_filename;
        $html = PRODUCTION ? ob_get_contents() : null;
        ob_end_clean();

        return $html;
    }
    public function render()
    {
        $args = func_get_args();
        $template_filename = $args[0];
        header('Content-Type: text/html; charset=utf-8');
        echo $this->fetch($template_filename);
    }
}
