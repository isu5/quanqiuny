<?php
//订阅
namespace app\common\model;
use think\Model;

class Feeds extends Model
{
    protected $pk = 'id';
	protected $insert = ['addtime'];
	protected function setAddtimeAttr($value){
		return time();
	}
	
	//后台查询数据
	public function getAll($pagesize=20){
		
		$data['list'] = $this
	
		->order('id desc')
		->paginate($pagesize);
		// 获取分页显示
		$data['page'] = $data['list']->render();
		//print_r($data);
		//dump($this->getLastSql());
		return $data;
	}
	//获取单条数据
	public function getOne($id){
		return Feeds::get($id);
	}
	
	public function add($data){
		return Feeds::create($data);
	}
}
