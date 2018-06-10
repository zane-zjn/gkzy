<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/3
 * Time: 3:01
 */

namespace app\index\controller;


use think\Request;

class Major extends Base
{
//专业信息控制器
    public function index (Request $request){
        $sid = $request->param('sid');
        $majors = \app\common\model\Major::all(['sid'=>$sid]);
        return $this->success($majors);
    }
}