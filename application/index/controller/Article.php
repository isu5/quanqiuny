<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Category as Cate;
use app\common\model\Article as Art;

class Article extends Controller{

	private $cate = null;
	private $art = null;
    public function _initialize(){
        parent::_initialize();
        $this->cate = new Cate();
        $this->art = new Art();
    }

    //列表页
    public function list(){
    	$id = input('param.pid');
    	//dump($pid);
       $data =  $this->art->field('id,bigtitle,author')->where('cid',$id)->order('id desc')->select();
       //需要分页
       //dump($data);
    	$this->assign('data',$data);
        return view();

    }

    //内容页
    public function item(){
    	$id = input('param.id');
    	//dump($id);
       $data =  $this->art->where('id',$id)->find();

       //halt($data);
    	$this->assign('data',$data);
        return view();
    }


}
