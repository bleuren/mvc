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
use core\MySQL;

class Method extends Model
{
    public function __construct()
    {
        $this->table = new MySQL('activities');
    }
    public function api()
    {
        return $this->table->api();
    }
    public function all()
    {
        return $this->table->all();
    }
    public function add($name, $url, $description)
    {
        $data = array('name' => htmlspecialchars($name), 'url' => htmlspecialchars($url), 'description' => htmlspecialchars_decode($description));

        return $this->table->save($data);
    }
    public function update($id, $name, $url, $description)
    {
        $data = array('name' => htmlspecialchars($name), 'url' => htmlspecialchars($url), 'description' => htmlspecialchars_decode($description));

        return $this->table->update($data, $id);
    }
    public function delete($id)
    {
        return $this->table->delete($id);
    }
    public function show($id)
    {
        return $this->table->find($id);
    }
    public function __destruct()
    {
        $this->table = null;
    }
}
