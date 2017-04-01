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

class MySQL implements IDatabase
{
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->link = $this->connect();
        $this->prefix = CONN['mysql']['prefix'];
    }
    private function connect()
    {
        static $link;
        if ($link !== null) {
            return $link;
        }
        $link = new \PDO('mysql'.':host='.CONN['mysql']['host'].';charset='.CONN['mysql']['charset'].';dbname='.CONN['mysql']['database'], CONN['mysql']['username'], CONN['mysql']['password'], array(\PDO::ATTR_PERSISTENT => CONN['mysql']['persistent'], \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

        return $link;
    }
    public function sql(string $sql, array $params = null)
    {
        $query = null;
        try {
            $query = $this->link->prepare($sql);
            $query->execute($params);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return $query;
    }
    public function api(): void
    {
        $link = $this->link;
        $method = $_SERVER['REQUEST_METHOD'];
        $query_string = explode('&', $_SERVER['QUERY_STRING']);
        $request = array();
        foreach ($query_string as $i => $v) {
            if (strpos($v, 'mod') === false && strpos($v, 'act') === false) {
                $request = array_merge($request, explode('=', $v));
            }
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $table = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));
        $key = array_shift($request) + 0;
        if (!empty($input)) {
            $columns = preg_replace('/[^a-z0-9_]+/i', '', array_keys($input));
            $values = array_map(function ($value) use ($link) {
                if ($value === null) {
                    return null;
                }

                return (string) $value;
            }, array_values($input));
            $set = '';
            for ($i = 0; $i < count($columns); ++$i) {
                $set .= ($i > 0 ? ',' : '').'`'.$columns[$i].'`=';
                $set .= $values[$i] === null ? 'NULL' : '"'.$values[$i].'"';
            }
        }
        switch ($method) {
            case 'GET':
                $sql = "select * from `{$table}`".($key ? " WHERE id={$key}" : '');
                break;
            case 'PUT':
                $sql = "update `{$table}` set {$set} where id={$key}";
                break;
            case 'POST':
                $sql = "insert into `{$table}` set {$set}";
                break;
            case 'DELETE':
                $sql = "delete from `{$table}` where id={$key}";
                break;
        }
        $result = $this->link->prepare($sql);
        $result->execute();
        if (!$result) {
            http_response_code(404);
            die;
        }
        if ($method === 'GET') {
            if (!$key) {
                echo '[';
            }
            $obj = $result->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($obj as $i => $v) {
                echo($i > 0 ? ',' : '').json_encode($v);
            }
            if (!$key) {
                echo ']';
            }
        }
        $this->link = null;
    }
    public function create(string $tableName, $attr = null)
    {
    }
    public function drop(string $tableName)
    {
    }
    public function getTableNames()
    {
    }
    public function getTable(string $tableName)
    {
    }
    public function getTables()
    {
    }
    public function all()
    {
        $args = func_get_args();
        if ($args != null) {
            $sql = "SELECT * FROM {$this->table} {$args['0']}";
        } else {
            $sql = "SELECT * FROM {$this->table}";
        }
        try {
            $query = $this->link->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return $result;
    }
    public function find(string $id)
    {
        $result = null;
        try {
            $sql = "SELECT COLUMN_KEY,COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$this->table}' AND COLUMN_KEY='PRI'";
            $query = $this->link->prepare($sql);
            $query->execute();
            $pri = $query->fetch(\PDO::FETCH_OBJ);
            $sql = "SELECT * FROM {$this->table} WHERE {$pri->COLUMN_NAME}=:pri";
            $query = $this->link->prepare($sql);
            $query->execute(array(':pri' => $id));
            $result = $query->fetch(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return $result;
    }
    public function save(array $data)
    {
        $returnValue = true;
        try {
            $col = null;
            $key = null;
            $val = null;
            foreach ($data as $name => $value) {
                $col = $col.'`'.$name.'`,';
                $key = $key.':'.$name.',';
                $val = $val.$value.',';
                $format_data[':'.$name] = $value;
            }
            $col = substr($col, 0, -1);
            $key = substr($key, 0, -1);
            $val = substr($val, 0, -1);
            $sql = "INSERT INTO `{$this->table}` ({$col}) VALUES ({$key})";
            $query = $this->link->prepare($sql);
            $query->execute($format_data);
            if ($returnValue) {
                $query = $this->link->prepare('SELECT @@IDENTITY as id');
                $query->execute();
                $result = $query->fetch(\PDO::FETCH_OBJ);
                $value = $result->id;
            } else {
                $value = true;
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return $value;
    }
    public function update(array $data, string $id)
    {
        try {
            $sql = "SELECT COLUMN_KEY,COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$this->table}' AND COLUMN_KEY='PRI'";
            $query = $this->link->prepare($sql);
            $query->execute();
            $pri = $query->fetch(\PDO::FETCH_OBJ);
            $col = null;
            $key = null;
            $val = null;
            foreach ($data as $name => $value) {
                $col = $col.'`'.$name.'`=:'.$name.',';
                $val = $val.$value.',';
                $format_data[':'.$name] = $value;
            }
            $format_data[':pri'] = $id;
            $col = substr($col, 0, -1);
            $key = substr($key, 0, -1);
            $val = substr($val, 0, -1);
            $sql = "UPDATE `{$this->table}` SET {$col} WHERE `{$pri->COLUMN_NAME}`=:pri";
            var_dump($format_data);
            $query = $this->link->prepare($sql);
            $query->execute($format_data);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return;
    }
    public function delete(string $id)
    {
        try {
            $sql = "SELECT COLUMN_KEY,COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$this->table}' AND COLUMN_KEY='PRI'";
            $query = $this->link->prepare($sql);
            $query->execute();
            $pri = $query->fetch(\PDO::FETCH_OBJ);
            $sql = "DELETE FROM {$this->table} WHERE {$pri->COLUMN_NAME}=:pri";
            $query = $this->link->prepare($sql);
            $query->execute(array(':pri' => $id));
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return;
    }
    public function __destruct()
    {
        $GLOBALS['PDO'] = null;
        $this->link = null;
    }
}
