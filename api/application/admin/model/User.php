<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 13:22
 */

namespace app\admin\model;

use think\exception\DbException;

class User extends \app\common\model\User
{
    public static function getAll()
    {
        try {
            return User::all();
        } catch (DbException $e) {
            return [];
        }
    }

    public static function searchByName($keyword)
    {
        try {
            return User::all(['uname' => $keyword]);
        } catch (DbException $e) {
        }
    }
}