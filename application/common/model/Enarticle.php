<?php

namespace app\common\model;

use think\Model;

class Enarticle extends Base
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
		->field('a.*,c.catename,d.catename as topcate')
		->join('__ENCATEGORY__ c ', 'c.id = a.cid')
		->join('__ENCATEGORY__ d ', 'd.id = c.pid')
		->where($where)
		->order('a.id desc')
		->paginate($pagesize);
		// 获取分页显示
		$data['page'] = $data['list']->render();
		//print_r($data);
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

    //前台搜索
    public function searchfront($pagesize=1){
		$where = [];
		$title = input('get.keyword');
		$year = input('get.year');
		$month = input('get.month');
		$state = input('get.state');
		if(!$title && !$year && !$month && !$state) return ['list'=>[],'page'=>''];
		if ($title) {
			$where['bigtitle'] = array('like',"%$title%");
		}
		$time = strtotime(date('Y-m-d H:i:s',time()));
		$t2018 = strtotime(date('Y-m-d H:i:s',1514736000));
		
		if($year){
			$where['addtime'] = array('between',"$t2018,$time");
		}
		if($month){
			//获取栏目
			$cate = db('category')->where('pid',$month)->select();
			$cateid=array_column($cate, 'id');
			$cateid = implode(',',$cateid);
			$where['cid'] = array('in',$cateid);
		}
		$data['list'] = $this
		->field('id,bigtitle,author')
		->where($where)
		->order('id desc')
		->paginate($pagesize,true,['query'=>['keyword'=>$title,'year'=>$year,'month'=>$month,'state'=>$state]]);
		//print_r($this->getLastSql());
		// 获取分页显示
		$data['page'] = $data['list']->render();
		
		//dump($data);die;
		
		return $data;
	}
	
}
