<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/4/28
 * Time: 16:59
 */

namespace app\index\controller;

use think\exception\DbException;
use think\Request;
use think\Loader;
use app\common\model\User as UserModel;

class Session extends Base
{

    public function index(Request $request)
    {
    }

    public function read(Request $request)
    {
        return 'read:' . $request->param('id');
    }

    public function save(Request $request)
    {
        try {
            $uname = $request->param('uname');
            $upw = $request->param('upw');
            // 验证用户输入是否合法
            $validate = Loader::validate('User');
            if (!$validate->check(['uname' => $uname, 'upw' => $upw])) {
                return $this->error($validate->getError());
            }
            // 通过用户名查询用户
            $user = UserModel::get(['uname' => $uname]);
            if ($user) {
                // 用户存在
                if ($user['upw'] == md5($upw)) {
                    $token = uuid();
                    $user['token'] = $token;
                    $user->save();
                    return $this->success($user);
                } else {
                    return $this->error('密码错误');
                }
            } else {
                // 用户不存在
                return $this->error('用户名不存在');
            }
        } catch (DbException $e) {
            return $this->error($e->getMessage());
        }
    }
}