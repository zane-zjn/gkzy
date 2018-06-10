<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/4/28
 * Time: 21:49
 */

namespace app\common;


class BaseController
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT');
    }

    /**
     * 返回成功数据
     * @param null $data 数据
     * @param string $message 信息
     * @param int $code 代码
     * @return \think\response\Json
     */
    public function success($data = null, $message = '操作成功', $code = 0)
    {
        return json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * 返回失败信息
     * @param string $message
     * @param int $code
     * @return \think\response\Json
     */
    public function error($message = '操作失败', $code = -1)
    {
        return json([
            'code' => $code,
            'message' => $message,
        ]);
    }
}