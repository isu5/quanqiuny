<?php
/**
* 登录控制器
*/
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends controller
{
	//登录方法
    public function index()
    {
    	if (request()->isPost()) {
    		$data = input('post.');
    		$admin = new Admin();
    		$rest = $admin->where('username',$data['username'])->find();
    		if($rest){

    		}else{
    			$this->error('用户名不存在');
    		}

    	}

    	
        return view('index');
    }

    //退出登录
    public function logout(){
    	session(null);

    }

}
