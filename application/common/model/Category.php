<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'qq_category';

    //实现添加功能
    public function store($data){
    	//执行验证
    	$result = $this->validate(true)->save($data);
    	//执行添加
    	if (false === $result) {
    		return ['valid'=>0,'msg'=>$this->getError()];
    	}else{
    		return ['valid'=>1,'msg'=>'添加成功'];
    	}

    	
    }

    //修改
    public function edit($data){

    	$res = $this->validate(true)->save($data,[$this->pk=>$data['id']]);
    	//执行添加
    	if ($res) {
    		return ['valid'=>1,'msg'=>'修改成功'];
    	}else{
    		return ['valid'=>0,'msg'=>$this->getError()];
    		
    	}
    }
}
