<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 17:18
 */

namespace app\admin\controller;


use think\Request;

class Major extends Base
{
    public function index(Request $request)
    {
        return $this->success(\app\admin\model\Major::searchBySid($request->param('sid')));

    }

    public function save(Request $request)
    {
        if (!$request->param('sid')) {
            return $this->error('操作失败');
        } else {
            $major = new \app\admin\model\Major();
            $major->sid = $request->param('sid');
            $major->mname = $request->param('mname');
            $major->mtype = $request->param('mtype');
            $major->mintroduce = $request->param('mintroduce');
            $major->save();
            return $this->success($major);
        }
    }

    public function delete(Request $request)
    {
        $mid = $request->param('id');
        $major = \app\admin\model\Major::searchById($mid);
        $major->delete();
        return $this->success($major);
    }

    public function update(Request $request)
    {
        $mid = $request->param('id');
        $major = \app\admin\model\Major::searchById($mid);
        $major['mname'] = $request->param('mname');
        $major['mtype'] = $request->param('mtype');
        $major['mintroduce'] = $request->param('mintroduce');
        $major->save();
        return $this->success($major);
    }
}