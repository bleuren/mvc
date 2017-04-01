<?php

/* ======================================== */
// Bleu Framework
// �t�ήج[�}�o : ���a��
// paste.ren@gmail.com
// Copyright c 2014 Jia-Huei Ren & DivStudio. All rights reserved
// �즸�i�J�Х��ק�config.php�ɮ�
// �ФŧR�����q���v�ŧi�A�_�h�̪k�l�s
/* ======================================== */

namespace core;

class Router
{
    protected $action = 'index';
    public function __construct()
    {
        $this->action = isset($_GET['act']) && is_string($_GET['act']) ? strtolower($_GET['act']) : 'index';
    }
    public function getAction():string
    {
        return $this->action;
    }
}
