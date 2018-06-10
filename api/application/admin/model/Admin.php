<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 12:50
 */

namespace app\admin\model;


use think\Model;

class Admin extends Model
{
    protected $table = 'admin';

    protected $pk = 'name';
}