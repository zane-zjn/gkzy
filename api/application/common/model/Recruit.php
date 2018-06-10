<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 14:15
 */

namespace app\common\model;


use think\Model;

class Recruit extends Model
{
    protected $table = 'recruit';
    protected $pk = 'rid';
    protected $type = [
        'rid' => 'integer',
        'sid' => 'integer',
        'rnumber' => 'integer',
    ];
}