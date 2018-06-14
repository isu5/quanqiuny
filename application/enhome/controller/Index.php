<?php
namespace app\enhome\controller;

use think\Controller;
use app\common\model\Encategory as Cate;

class Index extends Controller
{
	private $cate = null;
    public function _initialize(){
        parent::_initialize();
        $this->cate = new Cate();
    }
    //首页
    public function index()
    {

    	$data = $this->cate->where('pid',0)->select();
    	//dump($data);
    	$this->assign('data',$data);
        return view();
    }

    //栏目列表
    public function cate(){
    	$id = input('param.pid');
    	$data = $this->cate->where('pid',$id)->select();
    	//dump($data);
    	$this->assign('data',$data);
    	return view();
    }

}
