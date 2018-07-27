<?php
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{
    protected $rule=[
        "cat_name"=>"require|unique:category",
        "pid"=>"require"
    ];
    //定义验证规则不通过的提示信息
    protected $message=[
        "cat_name.require"=>"分类名称必填",
        "cat_name.unique"=>"分类名称重复",
        "pid.require"=>"必须选择一个分类",
    ];
    //定义验证的场景
    protected $scene=[
        "add"=>["cat_name","pid"],
        "upd"=>['cat_name'=>"require","pid"],
    ];
}