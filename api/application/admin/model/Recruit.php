<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 18:02
 */

namespace app\admin\model;


use think\exception\DbException;

class Recruit extends \app\common\model\Recruit
{
    public static function searchByIdProvince($sid, $rprovince = '广东省')
    {
        try {
            return Recruit::all(['sid' =>$sid,'rprovince'=>$rprovince]);
        } catch (DbException $e) {
        }
    }
    public static function searchById($rid)
    {
        try {
            return Recruit::get(['rid' =>$rid]);
        } catch (DbException $e) {
        }
    }
}