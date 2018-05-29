<?php
/**
*  栏目管理
*/
namespace app\admin\controller;
use think\Controller;

class Category extends Common
{
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

    	return $this->fetch();
    }
}
