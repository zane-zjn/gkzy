<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 18:05
 */

namespace app\admin\controller;


use think\Request;

class Recruit extends Base
{
    public function index(Request $request)
    {
        if (!$request->param('rprovince')) {
            return $this->success(\app\admin\model\Recruit::searchByIdProvince($request->param('sid'), '广东省'));
        }
        return $this->success(\app\admin\model\Recruit::searchByIdProvince($request->param('sid'), $request->param('rprovince')));

    }

    public function save(Request $request)
    {
        if (!$request->param('sid')) {
            return $this->error('操作失败');
        } else {
            $recruit = new \app\admin\model\Recruit();
            $recruit->sid = $request->param('sid');
            $recruit->rprovince = $request->param('rprovince');
            $recruit->rnumber = $request->param('rnumber');
            $recruit->rmajor = $request->param('rmajor');
            $recruit->rsubjest = $request->param('rsubjest');
            $recruit->save();
            return $this->success($recruit);
        }
    }

    public function delete(Request $request)
    {

        $rid = $request->param('id');
        $recruit = \app\admin\model\Recruit::searchById($rid);
        $recruit->delete();
        return $this->success($recruit);
    }

    public function update(Request $request)
    {
        $rid = $request->param('id');
        $recruit = \app\admin\model\Recruit::searchById($rid);
        $recruit['rnumber'] = $request->param('rnumber');
        $recruit['rmajor'] = $request->param('rmajor');
        $recruit['rsubjest'] = $request->param('rsubjest');
        $recruit->save();
        return $this->success($recruit);
    }
}