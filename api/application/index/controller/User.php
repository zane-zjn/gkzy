<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/4/28
 * Time: 16:59
 */

namespace app\index\controller;

use think\exception\DbException;
use think\Loader;
use think\Request;
use app\common\model\User as UserModel;

class User extends Base
{

    /**
     * 获取个人信息
     * @param Request $request
     * @return \think\response\Json
     */
    public function index(Request $request)
    {

        $token = $request->header('Authorization');

        return $this->success(UserModel::searchByToken($token));
    }

    /**
     * 获取个人信息
     * @param Request $request
     * @return string
     */
//    public function read(Request $request)
//    {
//        return 'read:' . $request->param('id');
//    }

    public function save(Request $request)
    {
        $uname = $request->param('uname');
        $upw = $request->param('upw');
        $validate = Loader::validate('User');
        if (!$validate->check(['uname' => $uname, 'upw' => $upw])) {
            return $this->error($validate->getError());
        }
        try {
            $users = UserModel::all(['uname' => $uname]);
        } catch (DbException $e) {
            return $this->error($e->getMessage());
        }
        if (count($users) > 0) {
            return $this->error('用户名存在');
        } else {
            $user = new UserModel();
            $user->uname = $uname;
            $user->upw = md5($upw);
            $user->save();
            return $this->success(null, '注册成功');
        }
    }

    public function update(Request $request)
    {
        $user = UserModel::searchByToken($request->param('token'));
        if ($request->param('uname')) {
            $user['umail'] = $request->param('umail');
            $user['uaddress'] = $request->param('uaddress');
            $user['usex'] = $request->param('usex');
            $user['ufraction'] = $request->param('ufraction');
            $user['uphoto'] = $request->param('uphoto');
            $user['usubject'] = $request->param('usubject');
            $user->save();
            return $this->success('$user');
        }

        if ($request->param('oldPassword')) {

            if (md5($request->param('oldPassword'))) {
                $user['upw'] = md5($request->param('newPassword'));
                $user->save();
                $user->save();
                return $this->success('$user');
            }
            return $this->error('原密码错误');
        }

    }
}