<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 22:08
 */

namespace app\admin\model;


use think\exception\DbException;

class Article extends \app\common\model\Article
{

    public static function getAll()
    {
        try {
            return Article::all();
        } catch (DbException $e) {
            return [];
        }
    }
    public static function searchById($keyword)
    {
        try {
            return Article::get(['aid' => $keyword]);
        } catch (DbException $e) {
        }
    }
}