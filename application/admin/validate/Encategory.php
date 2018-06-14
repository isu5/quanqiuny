<?php
//添加栏目的验证器
namespace app\admin\validate;
use think\Validate;

class Encategory extends Validate{

	//验证规则
	protected $rule = [
		'catename' => 'require',
		
	];

	//提示信息
	protected $message = [
		'catename.require' => '栏目名称不能为空',
		
	];
}