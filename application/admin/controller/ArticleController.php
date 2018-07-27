<?php
namespace app\admin\controller;
use app\admin\model\Article;
use app\admin\model\Category;
class ArticleController extends CommonController{
    public function add(){
        $artModel=new Article();
        $cateModel=new Category();
        if(request()->isPost()){
            $postData=input('post.');
            $rules=$this->validate($postData,'Article.add',[],true);
            if($rules!==true){
                $this->error(implode(',',$rules));
            }
            //判断是否有文件上传
            if($file=request()->file('img')){
                //定义上传文件的目录
                $uploadDir="./upload/";
                //定义上传文件的验证规则
                $condition=[
                    "size"=>1024*1024*2,
                    "ext"=>'png,jpg,gif,jpeg'
                ];
                //上传验证
                $info=$file->validate($condition)->move($uploadDir);
        if($info){
            $postData['ori_img']=$info->getSaveName();
        }else{
            $this->error($file->getError());
        }

                    
            }

            $res=$artModel->save($postData);
            if($res){
                $this->success('添加成功','/article/show');
            }else{
                $this->error("添加失败");
            }
        }
        $res=$cateModel->select()->toArray();
        $data=$cateModel->getSonsCat($res);
        return $this->fetch('',['data'=>$data]);
    }
}