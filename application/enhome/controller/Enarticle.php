<?php
namespace app\enhome\controller;
use think\Controller;
use app\common\model\Encategory as Cate;
use app\common\model\Enarticle as Art;

class Enarticle extends Controller{

	private $cate = null;
	private $art = null;
    public function _initialize(){
        parent::_initialize();
        $this->cate = new Cate();
        $this->art = new Art();
		$host = 'http://'.$_SERVER['HTTP_HOST'];
		//年份
		$year = date('Y');
		$this->assign([
		'year' => $year,
		'host' => $host
		]);
	
    }

    //列表页
    public function list(){
    	$id = input('param.pid');
    	//dump($id);
		//查出二级栏目
		$cate = $this->cate->where('id',$id)->find();
       $cateTop = db('encategory')->where('pid',$id)->select();
		
		foreach($cateTop as &$v){
			$v['art']  =  $this->art
					   ->field('id,bigtitle,author')
					   ->where('cid',$v['id'])
					   ->order('id acs')->select();
		}
    	$this->assign([
			'cateTop'=>$cateTop,
			'cate' => $cate['catealias']
		]);
        return view();

    }

    //内容页
    public function item(){
		$id = input('param.id');
		
    	//dump($id);
		$data =  $this->art->where('id',$id)->find();
		$cid = $this->cate->where('id',$data['cid'])->find();
		$pid = $this->cate->where('id',$cid['pid'])->find();
		
		//halt($pid['pid']);
    	$this->assign([
			
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
	 // halt($data);
      $state = input('get.state');

      $cateTop = db('Encategory')->where('pid',0)->order('id desc')->select();
	  
      foreach ($cateTop as $key => &$value) {
       
        $cateson = db('Encategory')->where('pid',$value['id'])->order('id desc')->select();
    
      }
    
      //dump($cateson);
      $this->assign([
          'state' => $state,
          'data'=>$data['list'],
          'page'=>$data['page'],
          'count'=>$data['num'],
          'cateTop' => $cateTop,
          'cateson' => $cateson
          ]);
      return view();

    }

}
