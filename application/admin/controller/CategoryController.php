<?php
/**
 * Created by PhpStorm.
 * User: z888
 * Date: 2018/7/26
 * Time: 19:58
 */
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Validate;
class CategoryController extends CommonController{
    //后台文章分类添加功能
    public function add(){
            $category=new Category();
            if(request()->isPost()){
                $postData=input('post.');
                //调用系统自带的验证器验证
          /*  $rules=[
                'cat_name'=>"require|unique:category",
                "pid"=>"require",
            ];
            $message=[
                "cat_name.require"=>"分类名称不能为空",
                "cat_name.unique"=>"分类名称不能重复",
                "pid.require"=>"请选择分类",
            ];

            $validate=new Validate($rules,$message);

            $result=$validate->check($postData);

            if(!$result){
                //如果验证没有成功
                $this->error($validate->getError());
            }*/  //自定义系统验证方法
                //使用封装的验证方法
            $relust=$this->validate($postData,"Category.add",[],true);
            if($relust!==true){
                $this->error(implode(',',$relust));
            }
            //验证通过之后进行数据入库
                $rull=Category::create($postData);
               if($rull){
                   $this->success("添加成功","/category/show");
               }else{
                   $this->error("添加失败");
               }

            }
            $data=$category->select()->toArray();

            //将数据提交给递归处理
            $res=$category->getSonsCat($data);
            //展示文章分类的添加
            return $this->fetch('',['res'=>$res]);
    }

    //后台文章分类展示功能
    public function show(){
        $category=new Category();
        $data=$category->field('t1.*,t2.cat_name p_name')
            ->alias('t1')
            ->join("tp_category t2",'t1.pid=t2.cat_id','left')
            ->select();
        $res=$category->getSonsCat($data);
        return $this->fetch('',['res'=>$res]);
    }

    //后台文章编辑分类功能
    public function update(){
        $category=new Category();
        $cat_id=input('cat_id');
        if(request()->isPost()){
            $postData=input('post.');
            //验证数据
            $result=$this->validate($postData,'Category.upd',[],true);
            if($result !==true){
                $this->error(implode(',',$result));
            }
            //进行编辑
        if($category->update($postData,['cat_id'=>$cat_id])){
            $this->success("编辑成功",url("/category/show"));
            }else{
            $this->error("编辑失败");
            }
        }
        $cat_id=input('cat_id');
        $data=$category->where('cat_id','=',$cat_id)->find()->toArray();
        $res=$category->select()->toArray();
        $ress=$category->getSonsCat($res);
       return $this->fetch('',
           ['data'=>$data,
            'res'=>$ress,
               ]);
    }

    //后台文章删除功能
    public function delete(){
        if(request()->isAjax()){
            //如果是ajax请求,接收参数
            $cat_id=input('cat_id');
            //判断分类下面是否有子分类
            $where=[
                'pid'=>$cat_id,
            ];
            $result1=Category::where($where)->find();
            if($result1){
                //说明有子分类
                $response=["code"=>-1,"message"=>"分类下有子分类,无法删除"];
                echo  json_encode($response);die;
            }
            //判断分类下是否有文章
            $result2=Article::where(['cat_id'=>$cat_id])->find();
            if($result2){
                $response=["code"=>-2,"message"=>"分类下有文章,无法删除"];
                echo  json_encode($response);die;
            }
            if(Category::destroy($cat_id)){
                $response=["code"=>200,"message"=>"删除成功"];
                echo json_encode($response);die;
            }else{
                $response=["code"=>-3,"message"=>"删除失败"];
                echo json_encode($response);die;
            }
        }
    }


}