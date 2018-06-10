<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 14:25
 */

namespace app\admin\controller;


use think\Request;

class Fraction extends Base
{
    public function index(Request $request)
    {
        if (!$request->param('fyear')) {
            return $this->success(\app\admin\model\Fraction::searchByIdYear($request->param('sid'), '2016'));
        }
        return $this->success(\app\admin\model\Fraction::searchByIdYear($request->param('sid'), $request->param('fyear')));

    }

    public function save(Request $request)
    {
        if (!$request->param('sid')) {
            return $this->error('操作失败');
        } else {
            $fraction = new \app\admin\model\Fraction();
            $fraction->sid = $request->param('sid');
            $fraction->fyear = $request->param('fyear');
            $fraction->faverage = $request->param('faverage');
            $fraction->fmin = $request->param('fmin');
            $fraction->fsubject = $request->param('fsubject');
            $fraction->fprovince = $request->param('fprovince');
            $fraction->save();
            return $this->success($fraction);
        }
    }

    public function delete(Request $request)
    {

        $fid = $request->param('id');
        $fraction = \app\admin\model\Fraction::searchById($fid);
        $fraction->delete();
        return $this->success($fraction);
    }

    public function update(Request $request)
    {
        $fid = $request->param('id');
        $fraction = \app\admin\model\Fraction::searchById($fid);
        $fraction['fmin'] = $request->param('fmin');
        $fraction['faverage'] = $request->param('faverage');
        $fraction->save();
        return $this->success($fraction);
    }
}