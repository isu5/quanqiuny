<?php
//添加栏目的验证器
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{

	//验证规则
	protected $rule = [
		'catename' => 'require',
		'sort' => 'require|number|between:1,9999'
	];

	//提示信息
	protected $message = [
		'catename.require' => '栏目名称不能为空',
		'sort.require' => '排序不能为空',
		'sort.number' => '排序必须为数字',
		'sort.between' => '排序必须在1-9999之间'
	];
}