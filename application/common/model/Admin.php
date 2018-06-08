<?php

namespace app\common\model;

use think\Model;
use think\Validate;

class Admin extends Model
{
	protected $pk = 'id';
   //自动完成
	protected $auto = ['login_ip','password','login_lasttime'];
	
	//插入ip
	protected function setLoginIpAttr($value){
		return request()->ip();
	}
	//修改器 密码
	/*protected function setPasswordAttr($value){
		return sha1($value);
	}*/
	protected function setLoginLasttimeAttr($value){
		return time();
	}

	//修改密码
	public function savePass($data){
		$validate = new Validate([
		    'password'=>'require|min',
			'repassword'=>'require|confirm:password',
		],[
			'password.require'=>'密码不能为空',
			'password.min'=>'密码长度不能少于6位',
			'repassword.require'=>'确认密码不能为空',
			'repassword.confirm'=>'两次密码不一致'
		]);
		
		if (!$validate->check($data)) {
			return ['valid'=>0,'msg'=>$validate->getError()];
		    
		}

		$res = $this->save([
			'password'=> sha1($data['password'])
			],[
			$this->pk => session('userid')
			]);
		//halt($this->getLastSql());
		//halt($data['password']);
		if ($res) {
    		return ['valid'=>1,'msg'=>'修改成功'];
    	}else{
    		return ['valid'=>0,'msg'=>$this->getError()];
    		
    	}
	}
}
