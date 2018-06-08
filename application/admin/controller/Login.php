<?php
/**
* 登录控制器
*/
namespace app\admin\controller;
use think\Controller;
use app\common\model\Admin;
class Login extends controller
{
	//登录方法
    public function index()
    {
    	if (request()->isPost()) {
    		$data = input('post.');
    		//dump($data);die;
    		$admin = new Admin();
    		$rest = $admin->where('username',$data['username'])->find();
    		if($rest){
    			if($rest['password'] == sha1($data['password'])) {
                    session('userid',$rest['id']);
    				session('username',$rest['username']);
    			}else{
    				return json(['status'=>201,'msg'=>'密码错误！']);
    				//$this->error('密码错误！');
    			}
    		}else{
    			return json(['status'=>202,'msg'=>'用户名不存在']);
    			
    			//$this->error('用户名不存在');
    		}
    		if(captcha_check($data['code'])){
    			return json(['status'=>200,'msg'=>'登录成功,正在跳转...']);
			 	//$this->success('登录成功','Index/index');
			}else{
				return json(['status'=>203,'msg'=>'验证码错误']);
				//$this->error('验证码错误');
			}

    	}

    	
        return view('index');
    }

    //退出登录
    public function logout(){
    	session(null);
		$this->success('退出成功！','Login/index');
    }

}
