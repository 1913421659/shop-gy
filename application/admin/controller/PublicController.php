<?php
namespace  app\admin\controller;
use think\Controller;
use think\Validate;
use  app\admin\model\User;
use think\Request;

class PublicController extends Controller{
    //后台登录页面
    public function login(Request $request){
        if(request()->isPost()){
            $postData=input('post.');
            $rule=[
                "username"=>"require|length:4,9",//用户名不能为空且用户名不能相同且用户名的长度必须在4-9位之间
                "password"=>"require",//密码不能为空
                "captcha"=>"require|captcha",
            ];
            $message=[
                "username.require"=>"用户名不能为空",
                "username.unique"=>"已经存在相同的用户名",
                "username.length"=>"用户名长度必须在4~9位之间",
                "password.require"=>"密码不能为空",
                "captcha.require"=>"验证码必填",
                "captcha.captcha"=>"验证码错误",
            ];
            $validate=new Validate($rule,$message);
            $result=$validate->check($postData);
           if(!$result){
               $this->error($validate->getError());
           }
           
            //调用模型方法检测用户名和密码是否争取
           $userModel=new User();
            $flag=$userModel->checkUser($postData['username'],$postData['password']);
            if($flag){
                //直接重定向后台
                $this->redirect('admin/index/index');
            }else{
                $this->error('用户名或者密码错误');
            }
        }

        return $this->fetch();
    }
    //后台退出功能
    public function  logout(){
       session(null);
       $this->redirect('/login');
    }
}