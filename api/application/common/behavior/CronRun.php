<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/4/28
 * Time: 22:47
 */

namespace app\common\behavior;


use think\Response;

class CronRun
{
    public function run(&$dispatch)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

//
//        header("Access-Control-Allow-Origin: *");
//        header('Access-Control-Allow-Headers:Authorization');
//        header("Access-Control-Allow-Methods: GET, POST, DELETE");
//        header("Access-Control-Allow-Credentials: true");
//        header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, Cache-Control,Authorization");


//        $host_name = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : "*";
        $headers = [
            "Access-Control-Allow-Origin" => "http://localhost:8080",
//            "Access-Control-Allow-Credentials" => 'true',
//            "Access-Control-Allow-Headers" => "x-token,x-uid,x-token-check,x-requested-with,content-type,Host",
            "Access-Control-Allow-Headers" => "Origin, X-Requested-With, Content-Type, Accept, Authorization",
            "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE",
        ];
        if($dispatch instanceof Response) {
            $dispatch->header($headers);
        } else if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            $dispatch['type'] = 'response';
            $response = new Response('', 200, $headers);
            $dispatch['response'] = $response;
        }
    }
}