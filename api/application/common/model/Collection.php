<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 14:22
 */

namespace app\common\model;


use think\exception\DbException;
use think\Model;

class Collection extends Model
{
    protected $table = 'collection';

    protected $pk = 'cid';

    protected $type = [

        'uid' => 'integer',
        'cid' => 'integer',
        'sid' => 'integer',

    ];

    public static function searchByUid($uid)
    {
        try {
            return Collection::all(['uid' => $uid]);
        } catch (DbException $e) {
        }
    }

    public static function searchByCid($cid)
    {

        return Collection::get(['cid' => $cid]);
    }
}