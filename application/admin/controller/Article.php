<?php
/**
*  内容管理
*/
namespace app\admin\controller;
use think\Controller;
use app\common\model\Category as CategoryModel;
use app\common\model\Article as ArticleModel;

class Article extends Common
{
    private $cate = null;
    private $art = null;
    public function _initialize(){
        parent::_initialize();
        $this->cate = new CategoryModel();
        $this->art = new ArticleModel();
    }
	//列表
    public function index()
    {   
        $data = $this->art->search();
       //halt($data);
        $this->assign([
            'data'=>$data['list'],
            'page'=>$data['page']
            ]);
        return $this->fetch();
    }
    //添加
    public function add(){

    	if(request()->isPost()){
    		//halt(input('post.'));
            $res = $this->art->store(input('post.'));
            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
    	}
        //获取分类
        $cateDate = $this->cate->getTree();
       // halt($cateDate);
    	$this->assign('cate',$cateDate);
        return $this->fetch();
    }


    //修改
    public function edit(){
        $id = input('param.id');

        if (request()->isPost()) {
           // halt(input('post.'));
           $res = $this->art->edit(input('post.'));

            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }

        //获取文章数据
        $data = $this->art->where('id',$id)->find();
       
        //获取分类
        $cateDate = $this->cate->getTree();
        $this->assign([
            'data' => $data,
            'cate' => $cateDate
        ]);
       return view();


    }


    //删除
    public function delete(){
        $id = input('param.id');
        if(ArticleModel::destroy($id)){
            return json(['valid'=>1,'msg'=>'删除成功']);
        }else{
            return json(['valid'=>0,'msg'=>'删除失败']);
        }
    }
	//图片上传
	public function editorUpload(){
		$files = request()->file();
		$imags = [];
		$errors = [];
		foreach($files as $file){
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info){
				// 成功上传后 获取上传信息
				// 输出 jpg
				//echo $info->getExtension();
				// 输出 42a79759f284b767dfcb2a0197904287.jpg
				//echo $info->getFilename();
				$path = '/uploads/'.$info->getSaveName();
				array_push($imags,$path);
			}else{
				// 上传失败获取错误信息
				//echo $file->getError();
				array_push($errors,$file->getError());
			}
		}
		if(!$errors){
			$msg['errno'] = 0;
			$msg['data'] = $imags;
			return json($msg);
		}else{
			$msg['errno'] = 1;
			$msg['data'] = $imags;
			$msg['msg'] = "上传出错";
			return json($msg);
		}
	}


    //期刊统计
    public function getclick(){
		// 开始月份
        $startMonth = input('post.beginTime')?str_replace('-' , '' ,input('post.beginTime')):date('Y' , time()).'01';
        // 现在月份
        $endMonth = input('post.endMonth')?input('post.endMonth'):date('Ym' , time());
		$times = [];
		for($i = intval($startMonth) ; $i <= intval($endMonth) ; $i++ ){
			$month1 = strtotime($i.'01');  //  月初
            $month2 = strtotime($i.date('t', strtotime($i.'01')).'235959'); // 月末
			$map[$i]['time'] = $month1;
            $times[] = date('Y-m' , $month1);
			$map[$i]['click'] = db('Article')->where('addtime','between',"$month1,$month2")->sum('click');
			
			$clicks[] = $map[$i]['click'];
		}
		rsort($map);
		$data = $this->art->getcount();
       halt($times);
        $this->assign([
            'data'	=>$data['list'],
            'page'	=>$data['page'],
			'times'	=>json_encode($times),
			'clicks' => json_encode($clicks)
            ]);

        return view();
    }

}
