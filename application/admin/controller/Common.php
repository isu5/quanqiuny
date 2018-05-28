<?php

namespace app\admin\controller;
use think\Controller;

class Common extends controller {
	
	//初始化
	public function _initialize(){
		

		if(!session('username')){
			$this->success("非法访问！正在跳转登录页面",'Login/index');
		}
	}



}


