<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 13:19
 */

namespace app\admin\controller;


use think\Request;

class User extends Base
{
    public function index(Request $request)
    {
        if ($request->param('query')) {
            return $this->success(\app\admin\model\User::searchByName($request->param('query')));
        }
        return $this->success(\app\admin\model\User::getAll());
    }

    public function update(Request $request)
    {
        $uid = $request->param('id');
        $user = \app\admin\model\User::get($uid);
        $user['upw'] = md5('123456');
        $user->save();
        return $this->success($user);
    }

    public function delete(Request $request)
    {
        $uid = $request->param('id');
        $user = \app\admin\model\User::get($uid);
        $user->delete();
        return $this->success($user);
    }
}