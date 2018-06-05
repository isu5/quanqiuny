<?php
/**
*  内容管理
*/
namespace app\admin\controller;
use think\Controller;
use app\common\model\Category as CategoryModel;
use app\common\model\Article as ArticleModel;

class Article extends Common
{
    private $cate = null;
    private $art = null;
    public function _initialize(){
        parent::_initialize();
        $this->cate = new CategoryModel();
        $this->art = new ArticleModel();
    }
	//列表
    public function index()
    {   
        $data = $this->art->search();
       //halt($data);
        $this->assign([
            'data'=>$data['list'],
            'page'=>$data['page']
            ]);
        return $this->fetch();
    }
    //添加
    public function add(){

    	if(request()->isPost()){
    		//halt(input('post.'));
            $res = $this->art->store(input('post.'));
            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
    	}
        //获取分类
        $cateDate = $this->cate->getTree();
       // halt($cateDate);
    	$this->assign('cate',$cateDate);
        return $this->fetch();
    }


    //修改
    public function edit(){
        $id = input('param.id');

        if (request()->isPost()) {
           // halt(input('post.'));
           $res = $this->art->edit(input('post.'));

            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }

        //获取文章数据
        $data = $this->art->where('id',$id)->find();
       
        //获取分类
        $cateDate = $this->cate->getTree();
        $this->assign([
            'data' => $data,
            'cate' => $cateDate
        ]);
       return view();


    }


    //删除
    public function delete(){
        $id = input('param.id');
        if(ArticleModel::destroy($id)){
            return json(['valid'=>1,'msg'=>'删除成功']);
        }else{
            return json(['valid'=>0,'msg'=>'删除失败']);
        }
    }


}
