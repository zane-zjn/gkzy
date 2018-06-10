<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 12:44
 */

namespace app\admin\controller;


use app\admin\model\Admin;
use app\common\BaseController;
use think\Request;


class Base extends BaseController
{
    public function __construct(Request $request)
    {
        $token = $request->header('Authorization');
        $admin = Admin::get(['token' => $token]);
        if (!$admin) {
            echo '{"code": 401, "message": "用户没有权限"}';
            exit(0);
        }
    }
}