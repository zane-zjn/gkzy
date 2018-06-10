<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/3
 * Time: 3:05
 */

namespace app\index\controller;


use think\Db;
use think\Request;

class Fraction extends Base
{
//分数线
    public function index(Request $request)
    {
        $data = Db::table('fraction')
            ->where('sid', $request->param('sid'))
            ->where('fyear', $request->param('fyear'))
            ->where('fsubject', $request->param('fsubject'))
            ->select();
        return $this->success($data);
    }
}