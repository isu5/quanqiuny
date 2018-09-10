<?php
namespace app\index\controller;

use think\Controller;
use app\common\model\Feeds as Feed;

class Feeds extends Controller{
	 public function _initialize(){
        parent::_initialize();
        $this->db = model('Feeds');
    }
	//首页
    public function index()
    {
		
		if(request()->isPost()){
			
			$data = input('post.');
			
			//halt($data);
    		$validate = validate('Feeds');
           if(!$validate->check($data)) $this->error($validate->getError());
		   if(!$data['identnum'] && $data['is_invoice'] ==1) $this->error('纳税人识别号不能为空');
		   if(!$data['regaddress'] && $data['is_invoice'] ==1) $this->error('注册地址不能为空');
		   if(!$data['regphone'] && $data['is_invoice'] ==1) $this->error('注册电话不能为空');
		   if(!$data['bank'] && $data['is_invoice'] ==1) $this->error('开户银行不能为空');
		   if(!$data['bankcard'] && $data['is_invoice'] ==1) $this->error('银行账户不能为空');
		  
		   $res = $this->db->add($data);
			$res?$this->success('订阅成功!' ):$this->error('订阅失败！');
			exit;
    	}
		$this->assign('type',1);
		return view();
	}
}