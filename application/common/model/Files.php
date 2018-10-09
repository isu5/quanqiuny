<?php
namespace app\common\model;
use think\Model;

class Files extends Model
{
	protected $auto = ['addtime'];
	protected function setAddTimeAttr($value){
		return time();
	}
	//实现添加功能
    public function store($data){
    	//执行验证
    	$result = $this->save($data);
    	//执行添加
    	if (false === $result) {
    		return ['valid'=>0,'msg'=>$this->getError()];
    	}else{
    		return ['valid'=>1,'msg'=>'添加成功'];
    	}

    }
    //删除
    public function del(){
    	$id = input('param.id');
    	return Files::destroy($id);
    }

    //获取全部数据
    public function getAll($pagesize=10){
    	$data['list'] = Files::order('id' , 'desc')->paginate($pagesize);
    	$data['page'] = $data['list']->render();
    	return $data;
    }
	
	//获取单条数据
	public function getOne($id){
		
		return Files::get($id);
	}
}