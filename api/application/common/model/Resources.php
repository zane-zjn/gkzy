<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 23:04
 */

namespace app\common\model;


use think\exception\DbException;
use think\Model;

class Resources extends Model
{
    protected $table = 'resources';
    protected $pk = 'rid';

    protected $type = [
        'rid' => 'integer'
    ];

    public static function searchByType($type)
    {
        try {
            return Resources::all(['rtype' => $type]);
        } catch (DbException $e) {
        }
    }
}