<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 12:46
 */

namespace app\admin\controller;


use app\admin\model\Admin;
use think\exception\DbException;
use think\Request;
use think\Session;

class Index extends Base
{
    public function __construct(Request $request)
    {

    }

    public function index()
    {
        $s = 'GitHub development platform inspired work From open source business host review code manage projects build software alongside millions other developers';
        $arr = explode(' ', $s);
//        for ($i = 0; $i < count($arr); $i++) {
//            $user = new \app\admin\model\User();
//            $user['uname'] = $arr[$i];
//            $user['upw'] = md5('123456');
//            $user->save();
//        }
        return dump($arr);
    }

    // 后台管理员登录
    public function login(Request $request)
    {
        try {
            $name = $request->param('name');
            $password = $request->param('password');
            $admins = Admin::all();
            if (count($admins) === 0) {
                // 初始化管理员帐号
                $admin = new Admin;
                $admin['name'] = $name;
                $admin['password'] = md5($password);
                $admin->save();
            } else {
                $admin = Admin::get(['name' => $name, 'password' => md5($password)]);
                if ($admin) {
                    // 登录成功操作
                    $token = uuid();
                    $admin['token'] = $token;
                    $admin->save();
                    return $this->success($token);
                } else {
                    return $this->error('登录名或密码错误，请立即去世');
                }
            }
        } catch (DbException $e) {
            return $this->error('服务器出错了，请立即去世');
        }
    }
}