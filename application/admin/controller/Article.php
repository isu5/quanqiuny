<?php
/**
*  内容管理
*/
namespace app\admin\controller;
use think\Controller;
use app\common\model\Category as CategoryModel;

class Article extends Common
{
    private $cate = null;
    private $art = null;
    public function _initialize(){
        parent::_initialize();
        $this->cate = new CategoryModel();
    }
	//列表
    public function index()
    {
        return $this->fetch();
    }
    //添加
    public function add(){


    	if(request()->isPost()){
    		dump($_POST);
    	}
        //获取分类
        $cateDate = $this->cate->select();
        //halt($cateDate);
    	$this->assign('cate',$cateDate);
        return $this->fetch();
    }
}
