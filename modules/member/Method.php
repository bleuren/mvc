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
use core\MySQL;

class Method extends Model
{
    public function __construct()
    {
        $this->member = new MySQL('members');
    }
    public function all()
    {
        return $this->member->all();
    }
    public function show($id)
    {
        return $this->member->find($id);
    }
    public function add($category, $title, $name, $photo, $phone, $email, $work)
    {
        $data = array('category' => $category, 'title' => $title, 'name' => $name, 'photo' => $photo, 'phone' => $phone, 'email' => $email, 'work' => htmlspecialchars_decode($work));

        return $this->member->save($data);
    }
    public function delete($id)
    {
		$item = $this->member->find($id);
		if(file_exists($item->photo)) {
			unlink($item->photo);
		}			
        return $this->member->delete($id);
    }
    public function update($id, $category, $title, $name, $photo, $phone, $email, $work)
    {
        $data = array('category' => $category, 'title' => $title, 'name' => $name, 'photo' => $photo, 'phone' => $phone, 'email' => $email, 'work' => htmlspecialchars_decode($work));

        return $this->member->update($data, $id);
    }
}
