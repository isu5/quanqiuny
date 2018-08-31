<?php
namespace app\admin\controller;
use think\Controller;

class Feeds extends Common{

	private $db = null;
    public function _initialize(){
        parent::_initialize();
		$this->db = model('Feeds');
    }
    //账户信息
    public function index(){
		/* if(){} */
		$data = $this->db->getAll();
		
		$this->assign([
            'data'=>$data['list'],
            'page'=>$data['page']
            ]);
		
    	return view();
    }
	
	//查看单个信息
	public function show(){
		
		$id = input('param.id');
		$data = $this->db->getOne($id);
		$this->assign('data',$data);
		return view();
	}
}