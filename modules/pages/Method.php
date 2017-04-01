<?php

/* ======================================== */
// Bleu Framework 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace modules\pages;

use core\Model;
use core\MySQL;

class Method extends Model
{
    public function __construct()
    {
        $this->table = new MySQL('pages');
        $this->table->link->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
    }
    public function upd($id, $name, $content, $url, $uid, $display)
    {
        $content = htmlspecialchars_decode($content);
        $query = $this->table->link->prepare('UPDATE `pages` SET 
        name = :name,
        content = :content,
        url = :url,
        uid = :uid,
        display = :display,
        upd_dte = CURRENT_TIMESTAMP
        WHERE id =:id');
        $query->execute([':id' => $id, ':name' => $name, ':content' => $content, ':url' => $url, ':uid' => $uid, ':display' => $display]);
        var_dump($query->errorinfo());
    }
    public function show($id)
    {
        $query = $this->table->link->prepare('SELECT * FROM pages WHERE id=:id');
        $query->execute([':id' => $id]);
        $result = $query->fetch(\PDO::FETCH_OBJ);

        return $result;
    }
    public function getTree($id)
    {
        $query = $this->table->link->prepare('SELECT `id` FROM pages WHERE `parent`=:parent');
        $query->execute([':parent' => $id]);
        $result = $query->fetchAll(\PDO::FETCH_OBJ);
        $arr = array();
        if (!empty($result)) {
            foreach ($result as $i => $v) {
                array_push($arr, $this->parseId($v->id), $this->getchild($v->id));
            }
        }

        return array_filter($arr);
    }
    public function getMenu($id, $depth)
    {
        $query = $this->table->link->prepare('
            SELECT node.*, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
            FROM pages AS node,
                    pages AS parent,
                    pages AS sub_parent,
                    (
                            SELECT node.name, (COUNT(parent.name) - 1) AS depth
                            FROM pages AS node,
                                    pages AS parent
                            WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                    AND node.id = :id
                            GROUP BY node.name
                            ORDER BY node.lft
                    )AS sub_tree
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
                    AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
                    AND sub_parent.name = sub_tree.name
            GROUP BY node.name
            HAVING depth = :depth
            ORDER BY node.lft;      
        ');
        $query->execute([':id' => $id, ':depth' => $depth]);
        $result = $query->fetchAll(\PDO::FETCH_OBJ);

        return $result;
    }
    public function all()
    {
        $obj = $this->getMenu(1, 1);
        foreach ($obj as $i => $v) {
            $obj[$i]->sub = $this->getMenu($v->id, 1);
            foreach ($obj[$i]->sub as $j => $k) {
                $obj[$i]->sub[$j]->sub = $this->getMenu($k->id, 1);
				usort($obj[$i]->sub, ['modules\pages\method', 'sort_by_display']);
            }
        }
        usort($obj, ['modules\pages\method', 'sort_by_display']);

        return $obj;
    }
	public function itemSort($order)
	{
		foreach($order as $i => $v) {
			$query = $this->table->link->prepare('UPDATE `pages` SET `display` = :i WHERE `id` = :v');
			$query->execute([':i' => $i+1, ':v' => $v]);			
		}
	}
    public static function sort_by_display($a, $b)
    {
        if ($a->display === $b->display) {
            return 0;
        }

        return $a->display > $b->display ? 1 : -1;
    }
    public function add($cate, $name, $content, $url, $uid, $display)
    {
        $content = htmlspecialchars_decode($content);
        try {
            $this->table->link->beginTransaction();
            $this->table->sql('LOCK TABLE pages WRITE;', []);
            $myLeft = $this->table->sql('SELECT lft FROM pages WHERE id = :cate;', [':cate' => $cate])->fetch(\PDO::FETCH_OBJ)->lft;
            $this->table->sql('UPDATE pages SET rgt = rgt + 2 WHERE rgt > :myLeft;', [':myLeft' => $myLeft]);
            $this->table->sql('UPDATE pages SET lft = lft + 2 WHERE lft > :myLeft;', [':myLeft' => $myLeft]);
            $this->table->save(['name' => $name, 'content' => $content, 'url' => $url, 'uid' => $uid, 'display' => $display, 'lft' => $myLeft + 1, 'rgt' => $myLeft + 2]);
            $this->table->sql('UNLOCK TABLES;', []);
            $this->table->link->commit();
        } catch (Exception $e) {
            $this->table->link->rollBack();
            die($e->getMessage());
        }
    }
    public function delete($id)
    {
        $query = $this->table->link->prepare('
        LOCK TABLE pages WRITE;

        SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
        FROM pages
        WHERE id = :id;

        DELETE FROM pages WHERE lft BETWEEN @myLeft AND @myRight;

        UPDATE pages SET rgt = rgt - @myWidth WHERE rgt > @myRight;
        UPDATE pages SET lft = lft - @myWidth WHERE lft > @myRight;

        UNLOCK TABLES;
        ');
        $query->execute([':id' => $id]);
    }
    public function reduceOrder($arr, &$rt)
    {
        if (is_array($arr)) {
            foreach ($arr as $v) {
                if (is_array($v)) {
                    $this->reduceOrder($v, $rt);
                } else {
                    $rt[] = $v;
                }
            }
        }

        return $rt;
    }
    public function parseName($name)
    {
        $query = $this->table->link->prepare('SELECT `id` FROM pages WHERE `title`=:title');
        $query->execute([':title' => $name]);
        $result = $query->fetchAll(\PDO::FETCH_OBJ);
    }
    public function parseId($id)
    {
        $query = $this->table->link->prepare('SELECT * FROM pages WHERE `id`=:id');
        $query->execute([':id' => $id]);
        $result = $query->fetch(\PDO::FETCH_OBJ);

        return $result;
    }
    public function __destruct()
    {
        $this->table = null;
    }
}
