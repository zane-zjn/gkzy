<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/3
 * Time: 3:06
 */

namespace app\index\controller;


use think\exception\DbException;
use think\Request;

class Collection extends Base
{
    public function index(Request $request)
    {
        $token = $request->header('Authorization');
        $user = \app\common\model\User::searchByToken($token);
        $uid = $user['uid'];
        $schoolId = \app\common\model\Collection::searchByUid($uid);
        for ($i = 0; $i < count($schoolId); $i++) {
            $schoolId[$i]['school'] = \app\common\model\School::searchBySid($schoolId[$i]['sid']);
        }
        return $this->success($schoolId);
    }

    public function read(Request $request)
    {
        $token = $request->header('Authorization');
        $user = \app\common\model\User::searchByToken($token);
        $uid = $user['uid'];
        $sid = $request->param('id');
        $collection = \app\common\model\Collection::get(['uid' => $uid, 'sid' => $sid]);
        return $this->success($collection);

    }

    public function save(Request $request)
    {
        $token = $request->header('Authorization');
        $user = \app\common\model\User::searchByToken($token);
        $uid = $user['uid'];
        $sid = $request->param('sid');
        $collection = new \app\common\model\Collection([
            'uid' => $uid,
            'sid' => $sid
        ]);
        $collection->save();
        return $this->success($collection);

    }

    public function delete(Request $request)
    {
        $cid = $request->param('id');
        $collection = \app\common\model\Collection::searchByCid($cid);
//        if ($collection)
        $collection->delete();
        return $this->success($collection);
    }
}