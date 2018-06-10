<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/4/28
 * Time: 21:43
 */

namespace app\index\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'uname|用户名'  =>  'require|max:25',
        'upw|密码' =>  'require|min:6|max:20',
    ];
}