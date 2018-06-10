<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 14:25
 */

namespace app\admin\model;


use think\exception\DbException;

class Fraction extends \app\common\model\Fraction
{
    public static function searchByIdYear($sid, $fyear = '2016')
    {
        try {
            return Fraction::all(['sid' =>$sid,'fyear'=>$fyear]);
        } catch (DbException $e) {
        }
    }
    public static function searchById($fid)
    {
        try {
            return Fraction::get(['fid' =>$fid]);
        } catch (DbException $e) {
        }
    }
}