<?php

namespace app\common\model;

use think\Model;

class Article extends Model
{
	protected $pk = 'id';
	protected $auto = ['addtime','uptime'];
	protected function setAddTimeAttr($value){
		return time();
	}
	protected function setUpTimeAttr($value){
		return time();
	}
	//搜索，翻页
	public function search($pagesize=20){
		$where = [];
		$title = input('get.title');
		if ($title) {
			$where['bigtitle|title'] = array('like',"%$title%");
		}
		$data['list'] = $this->alias('a')
		->field('a.*,c.catename')
		->join('__CATEGORY__ c ', 'c.id = a.cid')
		->where($where)
		->order('a.id desc')
		->paginate($pagesize);
		// 获取分页显示
		$data['page'] = $data['list']->render();
		//dump($data);die;
		//dump($this->getLastSql());
		return $data;
	}
    //添加
    public function store($data){
    	/*$data['addtime'] = time();
    	$data['uptime'] = time();*/
    	$result = $this->save($data);
    	//执行添加
    	if (false === $result) {
    		return ['valid'=>0,'msg'=>$this->getError()];
    	}else{
    		return ['valid'=>1,'msg'=>'添加成功'];
    	}
    }

    //修改
    public function edit($data){
    	//halt($data);
    	$res = $this->save($data,[$this->pk=>$data['id']]);
    	if ($res) {
    		return ['valid'=>1,'msg'=>'修改成功'];
    	}else{
    		return ['valid'=>0,'msg'=>$this->getError()];
    		
    	}
    }

}
