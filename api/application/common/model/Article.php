<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 21:48
 */

namespace app\common\model;


use think\exception\DbException;
use think\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $pk = 'aid';
    protected $type = [
        'aid' => 'integer'
    ];


    public static function searchById($aid)
    {
        try {
            return Article::get(['aid'=>$aid]);
        } catch (DbException $e) {
        }
    }
}
