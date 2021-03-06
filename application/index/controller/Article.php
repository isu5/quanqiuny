<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Category as Cate;
use app\common\model\Article as Art;

class Article extends Controller{

	private $cate = null;
	private $art = null;
    public function _initialize(){
        parent::_initialize();
        $this->cate = new Cate();
        $this->art = new Art();
		$year = date('Y');
		$this->assign('year',$year);
		
    }

	//列表页
	public function list(){
		$id = input('param.pid');
		//查出二级栏目
		$cate = $this->cate->where('id',$id)->find();
		//查出接收的pid 下的所有栏目
		$cateTop = db('category')->where('pid',$id)->select();
		
		foreach($cateTop as &$v){
			$v['art']  =  $this->art
					   ->field('id,bigtitle,author')
					   ->where('cid',$v['id'])
					   ->order('id acs')->select();
		}
		
		//$data = $this->cate->with('article')->where('pid',$id)->select();
		//var_dump($data);die;
		
	   $this->assign([
			'cateTop'=>$cateTop,
			'cate' => $cate['cateasname']
		]);
        return view();
	}

    //内容页
    public function item(){
    	$id = input('param.id');
		
		$data =  $this->art->where('id',$id)->find();
		//print_r($data);die;
		//查出当期期数
		$cid = $this->cate->where('id',$data['cid'])->find();
		//print_r($cid);die;
		$pid = $this->cate->where('id',$cid['pid'])->find();
		//$pid = $this->cate->where('id',$pid['id'])->find();
		//print_r($pid);die;
		$year = date('Y');
		//halt($year);
       //halt($data);
    	$this->assign([
			'year' => $year,
			'pid' => $pid['catealias'],
			'number' => $pid['numberart'],
			'imageFile' => $pid['imageFile'],
			'data'=>$data
		]);
        return view();
    }


    //搜索
    public function search(){
		$data = $this->art->searchfront();
		
		$state = input('get.state');
		
		$cateTop = db('category')->where('pid',0)->order('id desc')->select();
		
		
		$cateson = db('category')->where('pid',input('param.year'))->order('id desc')->select();
			
		/*  echo "<pre>";
		print_r($cateTop);
		print_r($cateson);  */
		//dump($cateson);
		$this->assign([
		  'state' => $state,
		  'data'=>$data['list'],
		  'page'=>$data['page'],
		  //'count'=>$data['count'],
		  'cateTop' => $cateTop,
		  'cateson' => $cateson,
		  
		  ]);
		return view();

    }

	public function searchlist(){
		$pid = input('param.pid');
		$cate = db('category')->where('pid',$pid)->order('id desc')->select();
		return $cate;
		
	}

	//增加点击量

    public function sethits(){
        $id = input('param.id');
        if(!$id){return;}
        db('article')->where('id',$id)->setInc('click');
    }

	
}
