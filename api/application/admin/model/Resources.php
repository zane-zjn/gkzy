<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 23:06
 */

namespace app\admin\model;




use think\exception\DbException;

class Resources extends \app\common\model\Resources
{
    public static function getByType($keyword){
        try {
            return Resources::all(['rtype' => $keyword]);
        } catch (DbException $e) {
        }
    }
    public static function searchByName($keyword)
    {
        try {
            return Resources::get(['rname' => $keyword]);
        } catch (DbException $e) {
        }
    }
    public static function searchById($keyword)
    {
        try {
            return Resources::get(['rid' => $keyword]);
        } catch (DbException $e) {
        }
    }
}