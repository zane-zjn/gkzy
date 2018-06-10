<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 16:54
 */

namespace app\admin\controller;


use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Request;

class School extends Base
{
    public function index(Request $request)
    {
        try {
            if($request->param('sid')){
                $sid = $request->param('sid');
                $school =\app\admin\model\School::get($sid);
                return $this->success($school);
            };
            if ($request->param('query')) {
                return $this->success(Db::table('school')
                    ->where('sname', 'like', '%' . $request->param('query') . '%')
                    ->select());
            }
            if ($request->param('count')) {
                return $this->success(db('school')->count());
            }
            $page = $request->param('page') ? $request->param('page') : 1;
            $size = $request->param('size') ? $request->param('size') : 10;
            return $this->success(Db::table('school')->limit(($page - 1) * $size . ',' . $size)->select());
        } catch (DataNotFoundException $e) {
        } catch (ModelNotFoundException $e) {
        } catch (DbException $e) {
        }

    }

    public function save(Request $request)
    {
        if (!$request->param('value')) {
            return $this->error('操作失败');
        } else {
            $school = new \app\admin\model\School();
            $school->sname = $request->param('value');
            $school->save();
            return $this->success($school);
        }
    }
    public function update(Request $request)
    {
        $sid = $request->param('id');
        try {
            $school = \app\admin\model\School::get($sid);
        } catch (DbException $e) {
        }
        $school['sname'] = $request->param('sname');
        $school['stype'] = $request->param('stype');
        $school['stime'] = $request->param('stime');
        $school['sregion'] = $request->param('sregion');
        $school['saddress'] = $request->param('saddress');
        $school['schara'] = $request->param('schara');
        $school['sarrang'] = $request->param('sarrang');
        $school['sphoto'] = $request->param('sphoto');
        $school['scost'] = $request->param('scost');
        $school['slink'] = $request->param('slink');
        $school['smember'] = $request->param('smember');
        $school['spropor'] = $request->param('spropor');
        $school['spicture'] = $request->param('spicture');
        $school['sintroduction'] = $request->param('sintroduction');
        $school->save();
        return $this->success($school);

    }
    public function delete(Request $request)
    {
        $sid = $request->param('id');
        try {
            $school = \app\admin\model\School::get($sid);
        } catch (DbException $e) {
        }
        $school->delete();
        return $this->success($school);
    }
}