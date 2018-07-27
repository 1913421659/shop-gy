<?php
/**
 * Created by PhpStorm.
 * User: z888
 * Date: 2018/7/27
 * Time: 16:24
 */
namespace app\admin\validate;
use think\Validate;

class Article extends Validate{
    protected $rule=[
        'title'=>"require|unique:article",
        'cat_id'=>"require",
    ];
    //股则不通过提示信息
    protected $message=[
        'title.require'=>'标题不能为空',
        "title.unique"=>"标题名重复",
        "cat_id.require"=>"必须选择一个所属文章分类",
    ];
    //验证场景
    protected $scene=[
        'add'=>['title','cat_id']
    ];
}