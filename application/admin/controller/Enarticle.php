<?php
/**
*  内容管理
*/
namespace app\admin\controller;
use think\Controller;
use app\common\model\Encategory as EncategoryModel;
use app\common\model\Enarticle as EnarticleModel;

class Enarticle extends Common
{
    private $cate = null;
    private $art = null;
    public function _initialize(){
        parent::_initialize();
        $this->cate = new EncategoryModel();
        $this->art = new EnarticleModel();
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
        if(EnarticleModel::destroy($id)){
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


}
