<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/3
 * Time: 2:16
 */

namespace app\index\controller;


use think\Request;

class Resources extends Base
{
    public function index(Request $request){
       if($request->param('rtype')){
           return $this->success(\app\common\model\Resources::searchByType($request->param('rtype')));
       }
       return $this->error('加载数据失败');
    }
}