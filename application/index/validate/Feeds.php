<?php
namespace app\index\validate;
use think\Validate;

class Feeds extends Validate{

	//验证规则
	protected $rule = [
		'fcompany'=>'require',
		'fusername'=>'require',
		'fphone'=>'number',
		'fax'=>'number',
		'fcnnum'=>'number',
		'fennum'=>'number',
		'femail'=>'require|email',
		'fcode'=>'number',
		'faddress'=>'require',
		'company'=>'require',
		

	];
	//对应的信息提示
	protected $message = [
		'fcompany.require'=>'订阅单位不能为空',
		'fusername.require'=>'订阅联系人不能为空',
		'fphone.number'=>'联系电话必须是数字',
		'fax.number'=>'传真必须是数字',
		'fcnnum.number'=>'中文订阅数量必须是数字',
		'fennum.number'=>'英文订阅数量必须是数字',
		'femail.require'=>'邮箱不能为空',
		'femail.email'=>'邮箱格式不对',
		'fcode.number'=>'邮编必须是数字',
		'faddress.require'=>'通信地址不能为空',
		'company.require'=>'开票单位不能为空',
		
	];
	
}