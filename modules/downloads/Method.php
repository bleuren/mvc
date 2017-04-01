<?php

namespace modules\downloads;

use core\Model;
use core\MySQL;

class Method extends Model
{
    public function __construct()
    {
        $this->downloads = new MySQL('downloads');
        $this->group = new MySQL('downloads_group');
    }
    public function getAlldownloads($group)
    {
        if ($group === '0') {
            $data = $this->downloads->all();
        } else {
            $data = $this->downloads->sql('SELECT * FROM downloads WHERE `group`=:group', array(':group' => $group))->fetchAll(\PDO::FETCH_OBJ);
        }
        foreach ($data as $i => $v) {
            $data[$i]->group = $this->group->find($v->group)->name;
        }

        return $data;
    }
    public function show($id)
    {
    	return $this->downloads->find($id);
    }
    public function delete($id)
    {
    	$item = $this->downloads->find($id);
    	if(file_exists($item->path)) {
    		unlink($item->path);
    	}
    	return $this->downloads->delete($id);
    }
    public function add($group, $name, $path, $author)
    {
        if ($group === '0')
            die('Please choose one group.');
        $data = array('group' => htmlspecialchars($group), 'name' => htmlspecialchars($name), 'path' => htmlspecialchars($path), 'author' => htmlspecialchars($author));
        $this->downloads->save($data);
    }
    public function allGroup()
    {
        return $this->group->all();
    }
    public function showGroup($id)
    {
        if (!($group = $this->group->find($id))) {
            $group = new \stdClass();
            $group->name = 'All downloads';
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
        $this->downloads = null;
        $this->group = null;
    }
}
