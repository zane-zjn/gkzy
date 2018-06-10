<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 14:08
 */

namespace app\common\model;


use think\Model;

class Fraction extends Model
{
    protected $table = 'fraction';
    protected $pk = 'fid';
    protected $type = [
        'fid' => 'integer',
        'sid' => 'integer',
        'faverage' => 'integer',
        'fmin' => 'integer',
    ];

}