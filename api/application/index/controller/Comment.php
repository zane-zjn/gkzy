<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/3
 * Time: 3:00
 */

namespace app\index\controller;


use think\exception\DbException;
use think\Request;

class Comment extends Base
{

    /**
     * @param Request $request
     * @return \think\response\Json
     */
    public function index(Request $request)
    {
        $sid = $request->param('sid');
        try {
            $comment = array_reverse(\app\common\model\Comment::all(['sid' => $sid]));
        } catch (DbException $e) {
        }
        if (count($comment) > 9) {
            $comment = array_slice($comment,0,10);
        }
        return $this->success($comment);
    }

    public function update(Request $request)
    {
        $token = $request->header('Authorization');
        $user = \app\common\model\User::searchByToken($token);
        $uname = $user['uname'];
        $uphoto = $user['uphoto'];
        $sid = $request->param('id');
        $ccontent = $request->param('ccontent');
        $ctime = date('Y-m-d H:i:s', time());
        $comment = new \app\common\model\Comment([
            'uname' => $uname,
            'uphoto' => $uphoto,
            'sid' => $sid,
            'ccontent' => $ccontent,
            'ctime' => $ctime,
        ]);

        $comment->save();
        return $this->success($comment);
    }
}