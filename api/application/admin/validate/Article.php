<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 22:28
 */

namespace app\admin\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'atitle|文章标题' => 'require',
        'acontent|文章内容' => 'require',
        'author|作者' => 'require'
    ];
}