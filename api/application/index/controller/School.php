<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/3
 * Time: 3:06
 */

namespace app\index\controller;


use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;

use think\exception\DbException;
use think\Request;

class School extends Base
{
//条件查询学校
    public function index(Request $request)
    {
        if($request->param('keyWord')){
            try {
                return $this->success(Db::table('school')
                    ->where('sname', 'like', '%' . $request->param('keyWord') . '%')
                    ->select());
            } catch (DataNotFoundException $e) {
            } catch (ModelNotFoundException $e) {
            } catch (DbException $e) {
            }
        }
        $sregion = $request->param('sregion');
        $stype = $request->param('stype');
        $sarrang = $request->param('sarrang');
        $schara = $request->param('schara');
        $data = Db::table('school');
        if ($sregion && $sregion != '不限')
            $data = $data->where('sregion', 'like', '%' . $sregion . '%');
        if ($stype && $stype != '不限')
            $data = $data->where('stype', 'like', '%' . $stype . '%');
        if ($sarrang && $sarrang != '不限')
            $data = $data->where('sarrang', 'like', '%' . $sarrang . '%');
        if ($schara && $schara != '不限')
            $data = $data->where('schara', 'like', '%' . $schara . '%');
        if ($request->param('count')) {
            return $this->success($data->count());

        }
        $page = $request->param('page') ? $request->param('page') : 1;
        $size = $request->param('size') ? $request->param('size') : 10;
        $data = $data->limit(($page - 1) * $size . ',' . $size)->select();
        return $this->success($data);
//        return $this->success([
//            'data' => $data,
//            'sregion' => $sregion,
//            'stype' => $stype,
//            'sarrang' => $sarrang,
//            'schara' => $schara,
//        ]);
    }
// 推荐学校实现
    public function read(Request $request)
    {
        $token = $request->header('Authorization');
        $user = \app\common\model\User::get(['token' => $token]);
        if (!$user) {
            echo '{"code": 402, "message": "请先登录"}';
            exit(0);
        }
        if (!$user['ufraction']) {
            return $this->error('请先填写高考分数');
        }
        $sregion = $request->param('sregion');
        $stype = $request->param('stype');
        $data = Db::table('school');
        if ($sregion && $sregion != '不限')
            $data = $data->where('sregion', 'like', '%' . $sregion . '%');
        if ($stype && $stype != '不限')
            $data = $data->where('stype', 'like', '%' . $stype . '%');
        $data = $data->select();
        // 循环每个学校 判断是否符合
        for ($i = 0; $i < count($data);) {
            $sid = $data[$i]['sid'];
            // 获取所有分数线
            try {
                $fractions = Db::table('fraction')
                    ->where(['sid' => $sid])
                    ->where('fsubject', 'like', '%' . $user['usubject'] . '%')
                    ->where('fprovince', 'like', '%' . $user['uaddress'] . '%')
                    ->order('fyear desc')
                    ->limit(6)
                    ->select();
            } catch (DataNotFoundException $e) {
            } catch (ModelNotFoundException $e) {
            } catch (DbException $e) {
            }
            $data[$i]['fractions'] = $fractions;
            if (count($fractions) < 6) {
                array_splice($data, $i, 1);
                continue;
            }
            // 最近一年 30 分内
            if (abs($user['ufraction'] - $fractions[0]['fmin']) > 30) {
                array_splice($data, $i, 1);
                continue;
            }
            $fmins = [];
            for ($j = 0; $j < count($fractions); $j++) {
                $fmins[$j] = $fractions[$j]['fmin'];
            }
            // 平均数
            $avg = avg($fmins);
            // 方差
            $var = variance($fmins);
            $data[$i]['$var'] = $var;
            $data[$i]['$avg'] = $avg;
            $flag = abs(($user['ufraction'] - $avg) / $var);
            $data[$i]['$flag'] = $flag;
            if ($flag > 10) {
                array_splice($data, $i, 1);
                continue;
            }
            $i++;
//            $data[$i]['usubject'] = $user['usubject'];

        }
        return $this->success($data);
    }

    public function update(Request $request)
    {
        $sid = $request->param('id');
        $school = \app\common\model\School::searchBySid($sid);
        return $this->success($school);
    }
}