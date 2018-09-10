<?php
namespace app\admin\model;
use think\Model;

class Admin extends Model{

	//自动完成
	protected $auto = ['ip','password','repassword'];
	
	//插入ip
	protected function setIpAttr(){
		return request()->ip();
	}
	//修改器 密码
	protected function setPasswordAttr($value){
		return sha1($value);
	}

}