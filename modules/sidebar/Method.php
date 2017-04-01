<?php

/* ======================================== */
// Bleu Framework
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace modules\sidebar;

use core\Model;
use core\MySQL;

class Method extends Model
{
    public function __construct()
    {
        $this->sidebar = new MySQL('sidebar');
    }
    public function show($id)
    {
        return $this->sidebar->find($id);
    }
    public function all()
    {
        return $this->sidebar->all();
    }
    public function add($name, $url, $target)
    {
        $data = array('name' => $name, 'url' => htmlspecialchars_decode($url), 'target' => $target);

        return $this->sidebar->save($data);
    }
    public function update($id, $name, $url, $target)
    {
        $data = array('name' => $name, 'url' => htmlspecialchars_decode($url), 'target' => $target);

        return $this->sidebar->update($data, $id);
    }
    public function delete($id)
    {
        return $this->sidebar->delete($id);
    }
}
