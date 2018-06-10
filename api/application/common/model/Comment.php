<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/2
 * Time: 14:19
 */

namespace app\common\model;


use think\Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $pk = 'cid';

    protected $type = [
        'cid'           =>  'integer',

    ];
}