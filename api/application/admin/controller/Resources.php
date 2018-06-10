<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 23:09
 */

namespace app\admin\controller;


use think\Request;

class Resources extends Base
{
    public function index(Request $request)
    {
        if (!$request->param('rtype')) {
            return $this->error('数据加载失败');
        }
        if ($request->param('rtype') === 'picture') {
            return $this->success(\app\admin\model\Resources::getByType('picture'));
        }
        if ($request->param('rtype') === 'link') {
            return $this->success(\app\admin\model\Resources::getByType('link'));
        }
    }

    public function update(Request $request)
    {
        if ($request->param('pic')) {
            $rname = $request->param('id');
            $rcontent = $request->param('rcontent');
            $resource = \app\admin\model\Resources::searchByName($rname);
            $resource['rcontent'] = $rcontent;
            $resource->save();
            return $this->success($resource);
        }
        if ($request->param('link')) {
            $rname = $request->param('rname');
            $rcontent = $request->param('rcontent');
            $rid = $request->param('rid');
            $resource = \app\admin\model\Resources::searchById($rid);
            $resource['rname'] = $rname;
            $resource['rcontent'] = $rcontent;
            $resource->save();
            return $this->success($resource);
        }
    }

    public function save(Request $request)
    {
        $resource = new \app\admin\model\Resources();
        $resource->rname = $request->param('rname');
        $resource->rcontent = $request->param('rcontent');
        $resource->rtype = 'link';
        $resource->save();
        return $this->success($resource);
    }

    public function delete(Request $request)
    {
        $rid = $request->param('id');
        $resource = \app\admin\model\Resources::searchById($rid);
        $resource->delete();
        return $this->success($resource);
    }

}