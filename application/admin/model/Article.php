<?php
/**
 * Created by PhpStorm.
 * User: z888
 * Date: 2018/7/25
 * Time: 19:39
 */
namespace app\admin\model;
use think\Model;

class Article extends Model{
    protected $pk='article_id';
    //时间自动维护
    protected  $autoWriteTimestamp=true;
}
