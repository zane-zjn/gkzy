<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 14:12
 */

namespace app\common\model;


use think\Model;

class Major extends Model
{
//    专业表
    protected $table = 'major';
    protected $pk = 'mid';
    protected $type = [
        'mid' => 'integer',
        'sid' => 'integer',

    ];

}