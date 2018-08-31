<?php
namespace app\index\validate;
use think\Validate;

class Feeds extends Validate{

	//验证规则
	protected $rule = [
		'fcompany'=>'require',
		'fusername'=>'require',
		'fphone'=>'require',
		'fax'=>'require',
		'femail'=>'require',
		'fcode'=>'require',
		'faddress'=>'require',
		

	];
	//对应的信息提示
	protected $message = [
		'fcompany.require'=>'订阅单位不能为空',
		'fusername.require'=>'订阅联系人不能为空',
		'fphone.require'=>'联系电话不能为空',
		'fax.require'=>'联系电话不能为空',
		'femail.require'=>'邮箱不能为空',
		'fcode.require'=>'邮编不能为空',
		'faddress.require'=>'通信地址不能为空',
		
	];
}