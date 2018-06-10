<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/3
 * Time: 2:17
 */

namespace app\index\controller;


use think\exception\DbException;
use think\Request;

class Article extends Base
{
    public function index(Request $request)
    {
        if (!$request->param('aid')) {
            try {
                return $this->success(\app\common\model\Article::all());
            } catch (DbException $e) {
            }
        }
            return $this->success(\app\common\model\Article::searchById($request->param('aid')));

    }
}