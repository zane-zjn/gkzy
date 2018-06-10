<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 17:17
 */

namespace app\admin\model;


use think\exception\DbException;

class Major extends \app\common\model\Major
{
    public static function searchById($mid)
    {
        try {
            return Major::get(['mid' => $mid]);
        } catch (DbException $e) {
        }
    }

    public static function searchBySid($sid)
    {
        try {
            return Major::all(['sid' => $sid]);
        } catch (DbException $e) {
        }
    }
}