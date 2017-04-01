<?php

namespace modules\article;

use core\Model;
use core\MySQL;

class Method extends Model
{
    public function __construct()
    {
        $this->table = new MySQL('articles');
        $this->group = new MySQL('articles_group');
        $this->table->link->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
    }
    public function add($data)
    {
        if ($data['group'] === '0') {
            die('Please choose one group');
        }
        $data['content'] = htmlspecialchars_decode($data['content']);
        $this->table->save($data);

        return true;
    }
    public function search($keyword)
    {
        $sql = 'SELECT * FROM articles WHERE title LIKE :key OR content LIKE :key OR file1 LIKE :key OR file2 LIKE :key OR file3 LIKE :key OR date LIKE :key';

        return $this->table->sql($sql, array(':key' => '%'.$keyword.'%'))->fetchAll(PDO::FETCH_OBJ);
    }
    public function show($id)
    {
        $obj = $this->table->find($id);
        if (empty($obj)) {
            return false;
        }

        return $obj;
    }
    public function update($data, $id)
    {
        $data['content'] = htmlspecialchars_decode($data['content']);

        return $this->table->update($data, $id);
    }
    public function all()
    {
        return array_reverse($this->table->all());
    }
    public function delete($id)
    {
        $item = $this->table->find($id);
        if (file_exists($item->file1)) {
            unlink($item->file1);
        }
        if (file_exists($item->file2)) {
            unlink($item->file2);
        }
        if (file_exists($item->file3)) {
            unlink($item->file3);
        }

        return $this->table->delete($id);
    }

    //Group
    public function getAllitems($group)
    {
        if ($group == 0) {
            $data = $this->table->all();
        } else {
            $data = $this->table->sql('SELECT * FROM articles WHERE `group`=:group', array(':group' => $group))->fetchAll(\PDO::FETCH_OBJ);
        }
        foreach ($data as $i => $v) {
            $data[$i]->group = $this->group->find($v->group)->name;
        }

        return $data;
    }
    public function allGroup()
    {
        return $this->group->all();
    }
    public function showGroup($id)
    {
        if (!($group = $this->group->find($id))) {
            $group = new \stdClass();
            $group->name = 'All';
        }

        return $group;
    }
    public function addGroup($name)
    {
        $data = array('name' => $name);

        return $this->group->save($data);
    }
    public function updateGroup($name, $id)
    {
        $data = array('name' => $name);

        return $this->group->update($data, $id);
    }
    public function deleteGroup($id)
    {
        return $this->group->delete($id);
    }

    public function __destruct()
    {
        $this->table = null;
    }
}
