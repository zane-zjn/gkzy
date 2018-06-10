<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/4/28
 * Time: 21:16
 */

namespace app\common\model;


use think\exception\DbException;
use think\Model;

class User extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'user';

    protected $pk = 'uid';

    protected $type = [
        'uid' => 'integer',
        'ufraction' => 'integer',


    ];

    public static function searchByToken($token)
    {
        try {
            return User::get(['token' => $token]);
        } catch (DbException $e) {
        }
    }

}