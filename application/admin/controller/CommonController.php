<?php
/**
 * Created by PhpStorm.
 * User: z888
 * Date: 2018/7/26
 * Time: 18:42
 */
namespace app\admin\controller;
use think\Controller;

class  CommonController extends  Controller{
    //控制器的初始化方法
    public function _initialize()  //_initialize
    {
        if(!session('user_id')){
            //没有session,提示登录在操作
            $this->success('请先登录后在试',url('/login'));
        }
    }
}