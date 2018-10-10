<?php
/**
 * 文件存储
 */
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Files extends Common{
	
	private $db = null;
    public function _initialize(){
        parent::_initialize();
		$this->db = model('Files');
    }

    public function index(){

        $data = $this->db->getAll();
        $this->assign([
            'data'=>$data['list'],
            'page'=>$data['page']
            ]);
    	return view();
    }	

    //获取单条数据
    public function show(){
        $id = input('param.id');
        $data = $this->db->getOne($id);
        $this->assign('data',$data);
        return view();
    }

    //生成二维码
    public function sccode($id){
        scQRcode($id);
    }

    /**
     * [add description]添加方法
     */
    public function add(){
    	
        if(request()->isPost()){
            # code...
            $data = input('post.');
           $res = $this->db->store(input('post.'));
           // dump($res);die;
            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }

    	return view();
    }


    /**
     * [delete description]删除文件
     * @return [type] [description]
     */
    public function delete(){
        $map = $this->db->del();
        if($map){
            return json(['valid'=>1,'msg'=>'删除成功']);
        }else{
            return json(['valid'=>0,'msg'=>'删除失败']);
        }
    }


    /**
     * [upload description]上传图片
     * @return [type] [description]
     */
    public function upload(){
        // 获取上传文件
       
        $file = request()->file('file');

        if($file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $date = date('Ymd',time());
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS. $date .DS,'');
            
            $path = DS.'uploads'.DS. $date.DS. $info->getSaveName();
            $name = $info->getSaveName();
            $filesize = $info->getSize();
            $fileext = $info->getExtension();
            if($info){
                 return json(['state'=>1,'path'=>$path,'filesize'=>$filesize,'fileext'=>$fileext,'name'=>$name]);
            }else{
                // 上传失败获取错误信息
                 return json(['state'=>0,'errmsg'=>'上传失败']);
            }
        }    
    
    }
}