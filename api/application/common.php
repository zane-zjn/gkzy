<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function uuid($prefix = "")
{    //可以指定前缀
    $str = md5(uniqid(mt_rand(), true));
    $uuid = substr($str, 0, 8) . '-';
    $uuid .= substr($str, 8, 4) . '-';
    $uuid .= substr($str, 12, 4) . '-';
    $uuid .= substr($str, 16, 4) . '-';
    $uuid .= substr($str, 20, 12);
    return $prefix . $uuid;
}

/**
 * 求平均数
 * @param $arr array 数据数组
 * @return float|int 平均数
 */
function avg($arr)
{
    $sum = 0;
    foreach ($arr as $value) {
        $sum += $value;
    }
    return $sum / count($arr);
}

/**
 * 求方差
 * @param $arr array 数据
 * @return float|int 方差
 */
function variance($arr)
{
    $av = avg($arr);
    $sum = 0;
    foreach ($arr as $value) {
        $sum += pow($value - $av, 2);
    }
    return $sum / count($arr);
}