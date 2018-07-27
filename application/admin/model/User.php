<?php
/**
 * Created by PhpStorm.
 * User: z888
 * Date: 2018/7/25
 * Time: 19:39
 */
namespace app\admin\model;
use think\Model;

class User extends Model{
    protected $pk='user_id';
    public function checkUser($username,$password){
        $where=[
            'username'=>$username,
            'password'=>md5($password.config('password_salt')),
        ];
        $userInfo=$this->where($where)->find();
        if($userInfo){
            session('user_id',$userInfo['user_id']);
            session('username',$userInfo['username']);
            return true;
      }else{
            return false;
        }
    }
}