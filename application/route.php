<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];*/
//自定义的测试方法
Route::any('index2','admin/test/index2');
Route::any('index','admin/test/index');
Route::any('index3','admin/test1/index3');
Route::any('model','admin/test/model');





//定义网站根目录的路由
Route::get('/','admin/index/index');

//后台首页路由
Route::get('left','admin/index/left');
Route::get('top','admin/index/top');
Route::get('main','admin/index/main');
//输出登录页面的路由
Route::any('login','admin/public/login');
//后台首页退出的路由
Route::get('logout','admin/public/logout');

//后台文章分类列表的添加
Route::any('category/add','admin/category/add');
//后台文章分类列表的展示
Route::any("category/show","admin/category/show");
//后台文章分类列表的编辑
Route::any("category/update",'admin/category/update');
//后台实现ajax无刷新删除
Route::get('category/delete','admin/category/delete');


//后台文章数据操作的添加路由
Route::any("article/add",'admin/article/add');
