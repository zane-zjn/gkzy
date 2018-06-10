<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 17:21
 */

namespace app\admin\model;


use think\exception\DbException;

class School extends \app\common\model\School
{
    public static function getAll()
    {
        try {
            return School::all();
        } catch (DbException $e) {
            return [];
        }
    }

    public static function searchByName($keyword)
    {
        try {
            return School::all($where['name'] = ['name', 'like', '%' . $keyword . '%']);
        } catch (DbException $e) {
        }
    }
    public static function searchById($keyword){
        try {
            return School::get(['sid' => $keyword]);
        } catch (DbException $e) {
        }
    }
}