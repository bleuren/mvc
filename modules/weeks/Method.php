<?php

namespace modules\weeks;

use core\Model;
use core\MySQL;

class Method extends Model
{
    public function __construct()
    {
        $this->table = new MySQL('weeks');
    }
    public function getAllPosts()
    {
        $data = array();
        $years = $this->table->sql('SELECT DISTINCT (year) FROM `weeks`ORDER BY year DESC ')->fetchAll(\PDO::FETCH_OBJ);
        foreach ($years as $year) {
            $obj = $this->table->sql('SELECT * FROM `weeks` WHERE year=:year ORDER BY month DESC ', array('year' => $year->year))->fetchAll(\PDO::FETCH_OBJ);
            $data[$year->year] = $obj;
        }

        return $data;
    }
	public function show(int $id)
	{
		return $this->table->find($id);
	}
    public function add($year, $month, $week, $file, $author)
    {
        $data = array('year' => $year, 'month' => $month, 'week' => $week, 'file' => $file, 'author' => $author);
        $this->table->save($data);
    }
	public function delete(int $id)
	{
		$item = $this->table->find($id)->file;
		if(file_exists($item)) {
			unlink($item);
		}
		return $this->table->delete($id);
	}
    public function __destruct()
    {
        $this->table = null;
    }
}
