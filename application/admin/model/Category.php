<?php
/**
 * Created by PhpStorm.
 * User: z888
 * Date: 2018/7/25
 * Time: 19:39
 */
namespace app\admin\model;
use think\Model;

class Category extends Model{
    protected $pk='cat_id';
    //完成时间戳的自动维护
    protected $autoWriteTimestamp=true;

    public function getSonsCat($data,$pid=0,$level=1){
        static $result = [];//静态数据,后面递归调用的时候只会初始化一次
        foreach ($data as $v){
            if($v['pid']==$pid){
                $v['level']=$level;//加一个层级关系
                $result[]=$v;
                //递归调用找子孙分类
                $this->getSonsCat($data,$v['cat_id'],$level+1);
            }
        }
        return $result;
    }
}

