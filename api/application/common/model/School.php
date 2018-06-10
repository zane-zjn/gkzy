<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 16:56
 */

namespace app\common\model;


use think\exception\DbException;
use think\Model;

class School extends Model
{
    protected $table = 'school';
    protected $pk = 'sid';
    protected $type = [
        'sid' => 'integer',
        'smember' => 'integer',
    ];

    public static function searchBySid($sid)
    {
        try {
            return School::get(['sid' => $sid]);
        } catch (DbException $e) {
        }
    }
}