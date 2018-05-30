<?php
/**
*  栏目管理
*/
namespace app\admin\controller;
use think\Controller;
use app\common\model\Category as CategoryModel;

class Category extends Common{ 

    private $db = null;
    public function _initialize(){
        parent::_initialize();
        $this->db = new CategoryModel();
    }
	//列表
    public function index() {


        $data = db('category')->order('sort desc')->select();
        
        $this->assign('data',$data);
        return $this->fetch();
    }
    //添加
    public function add(){
    	if(request()->isPost()){
    		//halt(input('post.'));
            $res = $this->db->store(input('post.'));
           // dump($res);die;
            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
    	}

    	return $this->fetch();
    }

    //修改
    public function edit(){

        $id = input('param.id');
       
        if (request()->isPost()) {
           $res = $this->db->edit(input('post.'));
            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }


        $data = $this->db->where('id',$id)->find();

        $this->assign('data',$data);

        return  view();
    }

    //删除
    public function delete(){
        
    }

}
