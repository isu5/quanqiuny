<?php
//订阅
namespace app\common\model;
use think\Model;

class Feeds extends Model
{
    protected $pk = 'id';
	protected $insert = ['addtime'];
	protected function setAddtimeAttr($value){
		return date('Y-m-d H:i:s',time());
	}
	
	//后台查询数据
	public function getAll($pagesize=20){
		
		$is_invoice = input('param.is_invoice' , 2);
		if($is_invoice != 2) $where['is_invoice'] = array('eq',$is_invoice);
	
		$data['list'] = $this
		->where($where)
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
	
	//获取所有数据
	public function getAllList(){
		/* //$data = $this
		->field('id,fcompany,fusername,fsex,fphone,
		fax,fcnnum,fennum,femail,fcode,faddress,is_invoice,company,identnum,
		regaddress,regphone,bank,bankcard,addtime')
		->order('id desc')->select(); */
		
		$is_invoice = input('param.is_invoice');
		if ($is_invoice != '') {
			$where['is_invoice'] = array('eq',$is_invoice);
		}
		if($is_invoice==1){  //开发票
		
			$data = $this
			->order('id desc')
			->where($where)
			->select();
			
			
		}elseif($is_invoice==0){
			$data = $this
			->field('id,fcompany,fusername,fsex,fphone,
		fax,fcnnum,fennum,femail,fcode,faddress,is_invoice,company,addtime')
			->where($where)
			->order('id desc')->select();
			//dump($this->getLastSql());
		}else{
			$data = $this
			->order('id desc')
			->select();
		}
		
		return $data;
	}
	
	
	
}
