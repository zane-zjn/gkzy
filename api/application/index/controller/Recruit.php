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

class Recruit extends Base
{
//招生计划
    public function index(Request $request)
    {

        $data = Db::table('recruit')
            ->where('sid', $request->param('sid'))
            ->where('rprovince', 'like', $request->param('rprovince') . '%')
            ->select();
        return $this->success($data);

    }
}