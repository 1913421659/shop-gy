<?php
/**
 * Created by PhpStorm.
 * User: z888
 * Date: 2018/7/25
 * Time: 18:53
 */
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Test1Controller extends  Controller{
    public function index3(Request $request){

        return $this->fetch();
    }
}