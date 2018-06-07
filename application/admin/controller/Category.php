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

        $data = $this->db->getTree();
        //halt($data);
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
        $data = $this->db->getTree();
        //halt($data);
        $this->assign('data',$data);
    	return $this->fetch();
    }

    //修改
    public function edit(){

        $id = input('param.id');
       
        if (request()->isPost()) {
            /*halt(input('post.'));*/
           $res = $this->db->edit(input('post.'));
            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }


        $data = $this->db->where('id',$id)->find();
        $cate = $this->db->getTree();
        $this->assign([
            'data'=>$data,
            'cate'=>$cate
        ]);

        return  view();
    }

    //删除
    public function delete(){
         $id = input('param.id');
         $pid = $this->db->where('id',$id)->find();
        // halt($pid['pid']);
         if ($pid['pid'] == 0) {
            return json(['valid'=>2,'msg'=>'该栏目为顶级栏目不允许删除！']);
         }
         if(CategoryModel::destroy($id)){
            return json(['valid'=>1,'msg'=>'删除成功']);
         }else{
            return json(['valid'=>0,'msg'=>'删除失败']);
         }
    }

}
