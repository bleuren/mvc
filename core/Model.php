<?php

/* ======================================== */
// Bleu Framework 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace core;

abstract class Model
{
    // public function uploadImg($img, $imgSize, $mythumb = null)
    // {
        // $temp = $img['tmp_name'];
        // $type = $img['type'];
        // $name = $img['name'];
        // $size = number_format($img['size'] / 1024, 1, '.', '');
        // if (substr($type, 0, 5) == 'image' and $size < 1024 and $name == basename($name)) {
            // $get_img = getimagesize($temp);
            // switch ($get_img[2]) {
                // case '1':
                    // $src = imagecreatefromgif($temp);
                    // break;
                // case '2':
                    // $src = imagecreatefromjpeg($temp);
                    // break;
                // case '3':
                    // $src = imagecreatefrompng($temp);
                    // break;
                // default:
                    // return null;
            // }
            // $src_w = imagesx($src);
            // $src_h = imagesy($src);
            // if ($src_w > $src_h) {
                // $thumb_w = $imgSize;
                // $thumb_h = intval($src_h / $src_w * $imgSize);
            // } else {
                // $thumb_h = $imgSize;
                // $thumb_w = intval($src_w / $src_h * $imgSize);
            // }
            // $thumb = imagecreatetruecolor($thumb_w, $thumb_h);
            // imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
            // ob_start();
            // imagepng($thumb);
            // $thumbData = ob_get_contents();
            // ob_end_clean();
            // $mythumb = base64_encode($thumbData);
        // }

        // return $mythumb;
    // }
    // public function upload($target_dir, $file, $size, $formats)
    // {
        // $target_file = $target_dir.iconv('BIG5', 'UTF-8//IGNORE', time().'_'.basename($file['name']));
        // $uploadOk = 1;
        // $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // $msg = '';
        // if (file_exists($target_file)) {
            // $msg .= 'Sorry, file already exists.';
            // $uploadOk = 0;
        // }
        // if ($file['size'] > $size) {
            // $msg .= 'Sorry, your file is too large.';
            // $uploadOk = 0;
        // }
        // if (!in_array($fileType, $formats)) {
            // $msg .= 'Sorry, type wrong.';
            // $uploadOk = 0;
        // }
        // if ($uploadOk === 0) {
            // $target_file = null;
            // $msg .= 'Sorry, your file was not uploaded.';
        // } else {
            // if (move_uploaded_file($file['tmp_name'], $target_file)) {
                // $msg .= 'The file '.basename($file['name']).' has been uploaded.';
            // } else {
                // $msg .= 'Sorry, there was an error uploading your file.';
            // }
        // }
        // echo PRODUCTION ? null : $msg;

        // return $target_file;
    // }
    public function paganation(array $display_array, $show_per_page, $page)
    {
        $obj = new \stdClass();
        if (!empty($display_array)) {
            $obj->total_page = ceil(count($display_array) / $show_per_page);
            if ($page < 1) {
                $page = 1;
            } elseif ($page >= $obj->total_page) {
                $page = $obj->total_page;
            }
            $start = ($page - 1) * $show_per_page;
            $obj->content = array_slice($display_array, $start, $show_per_page);
            $obj->current_page = $page;
        } else {
            $obj->total_page = 1;
            $obj->content = $display_array;
            $obj->current_page = $page;
        }

        return $obj;
    }
    public function parse_query(string $str)
    {
        if (is_string($str)) {
            $obj = parse_url($str);
            if (isset($obj['query'])) {
                $query = explode('&', $obj['query']);
                $params = array();
                foreach ($query as $i => $v) {
                    $v = explode('=', $v);
                    $params[$v[0]] = $v[1];
                }

                return $params;
            }
        }

        return false;
    }
}
