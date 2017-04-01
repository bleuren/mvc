<?php

/* ======================================== */
// Bleu Framework 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class Mongo
{
    public function set()
    {
        try {
            $conn = $GLOBALS['CONNECTIONS']['mongo'];
            $mongoClient = new \MongoClient('mongodb://'.$conn['host']);
            $link = $mongoClient->{$conn}['database'];

            return $link;
        } catch (Exception $e) {
            echo 'Error!: '.$e->getMessage().'<br />';
        }
    }
}
