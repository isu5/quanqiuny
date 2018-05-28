<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{

	//验证规则
	protected $rule = [
		'username|用户名'=>'require|min:5',
		'password|密码'=>'require|min:6|confirm:repassword',

	];
	//对应的信息提示
	protected $message = [
		'username.require'=>'用户名不能为空',
		'username.min' => '用户名长度不能少于5位',
		'password.require'=>'密码不能为空',
		'password.min'=>'密码长度不能少于6位',
		'password.confirm'=>'两次密码不一致'
	];
}