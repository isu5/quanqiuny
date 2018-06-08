<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{

	//验证规则
	protected $rule = [
		'password'=>'require|min',
		'repassword'=>'require|confirm:password',

	];
	//对应的信息提示
	protected $message = [
		'password.require'=>'密码不能为空',
		'password.min'=>'密码长度不能少于6位',
		'repassword.require'=>'确认密码不能为空',
		'repassword.confirm'=>'两次密码不一致'
	];
}