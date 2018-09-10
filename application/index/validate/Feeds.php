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
		'fcnnum'=>'require|number',
		'fennum'=>'require|number',
		'fax'=>'require',
		'femail'=>'require|email',
		'fcode'=>'require|number',
		'faddress'=>'require',
		'company'=>'require',
		

	];
	//对应的信息提示
	protected $message = [
		'fcompany.require'=>'订阅单位不能为空',
		'fusername.require'=>'订阅联系人不能为空',
		'fphone.require'=>'联系电话不能为空',
		'fax.require'=>'传真不能为空',
		'fcnnum.require'=>'中文订阅数量不能为空',
		'fcnnum.number'=>'中文订阅数量必须是数字',
		'fennum.require'=>'英文订阅数量不能为空',
		'fennum.number'=>'英文订阅数量必须是数字',
		'femail.require'=>'邮箱不能为空',
		'femail.email'=>'邮箱格式不对',
		'fcode.require'=>'邮编不能为空',
		'fcode.number'=>'邮编必须是数字',
		'faddress.require'=>'通信地址不能为空',
		'company.require'=>'开票单位不能为空',
		
	];
	
}