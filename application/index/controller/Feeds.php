<?php
namespace app\index\controller;

use think\Controller;

class Feeds extends Controller{
	 public function _initialize(){
        parent::_initialize();
        $this->db = db('Feeds');
    }
	//首页
    public function index()
    {
		if(request()->isPost()){
			$data = input('post.');
    		$validate = validate('Feeds');
           if(!$validate->check($data)) $this->error($validate->getError());
		   $res = $this->db->insert($data);
			$res?$this->success('订阅成功!' ):$this->error('订阅失败！');
			exit;
    	}
		return view();
	}
}