<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Admin as AdminModel;

class Admin extends Common{

	private $db = null;
    public function _initialize(){
        parent::_initialize();
        $this->db = new AdminModel();
    }
    //账户信息
    public function index(){

    	$data = $this->db->select();
    	$this->assign('data',$data);

    	return view();
    }

    //修改密码
	public function edit(){

		if (request()->isPost()) {
			$res = $this->db->savePass(input('post.'));
			if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{

                $this->error($res['msg']);

            }
		}

		return view(); 
	}
}