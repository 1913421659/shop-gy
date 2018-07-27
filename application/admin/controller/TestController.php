<?php
/**
 * Created by PhpStorm.
 * User: z888
 * Date: 2018/7/25
 * Time: 18:50
 */
namespace app\admin\controller;
use think\Controller;
use think\Model;
use think\Request;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Db;
class TestController extends Controller{
    public function index2(Request $request){
        /*dump($request->isGet());
        dump($request->controller());
        dump($request->module());*/
       dump(input('get.'));
        return "这是Test控制器下的index2方法";
    }
    public function index(){
       $cateGory=Category::get(1);
       dump($cateGory->toArray());
    }
    public function model(){
        //实例化模型
        //$catModel=new Category();
        //dump($catModel->get(2)->toArray());

        /*//添加数据
        $data=[
            'cat_name'=>"足球",
            'pid'=>1,
        ];
        $catModel=new Category();
        dump($catModel->save($data));*/

       /* //添加多条数据
        $data=[
            ['cat_name'=>"台球",'pid'=>1,'namespace'=>"hah"],
        ];
        $catModel=new Category();
        dump($catModel->allowField(true)->saveAll($data));*/

      /* //更新语句
        $data=[
            'cat_name'=>"高尔夫球",
            'pid'=>'2',
            'cat_id'=>"7",
        ];
        $catgory=new Category();
        dump($catgory->update($data));*/

      /*//删除语句
        dump(Category::destroy(7));*/

      //查询操作
        /*$catModel=new Category();
        $data=$catModel->field("cat_name,cat_id")
            ->order("cat_id desc")
            ->where("cat_id",'>',"2")
            ->select()
            ->toArray();
        dump($data);*/

        //查询单条
        /*$catgory=new Category();
        dump($catgory->where('cat_id','=','5')->select()->toArray());*/

        /*$catgory=new Category();
        dump($catgory->field("cat_name,pid")->select()->toArray());*/

        //join连表查询
       /* $catModel=new Article();
        $data=$catModel
            ->field('t1.*,t2.cat_name as p_name')
            ->alias("t1")
            ->join("tp_category t2",'t1.cat_id=t2.cat_id','left')
            ->select()
            ->toArray();
        dump($data);*/

      /* //使用db类进行查询
        $date=Db::table('tp_category')->field('cat_name,pid')->select();
        dump($date);*/

        //使用db类进行编辑
        /*Db::table('tp_article')->where('article_id,2')->update(['title'=>"无氧运动哈哈"]);*/
        //echo md5("123456".config('password_salt'));
    }

}