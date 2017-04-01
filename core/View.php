<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace core;

abstract class View
{
    protected $vars = array();
    public function setVar($tpl_var, $value = null): void
    {
        if (is_array($tpl_var)) {
            foreach ($tpl_var as $key => $val) {
                if ($key != '') {
                    $this->vars[$key] = $val;
                }
            }
        } else {
            if ($tpl_var != '') {
                $this->vars[$tpl_var] = $value;
            }
        }
    }
    public function __get($name)
    {
        return isset($this->vars[$name]) ? $this->vars[$name] : null;
    }
    abstract public function fetch();
    abstract public function render();
}
