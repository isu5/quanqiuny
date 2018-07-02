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
           // halt(input('post.'));
           $res = $this->db->edit(input('post.'));
            if ($res['valid']) {
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }
		
	
        $data = $this->db->where('id',$id)->find();
        $cate = $this->db->getTree();
		//图片
		$imageFile = $data['imageFile'];
		//dump($imageFile);
		//dump($data);
        $this->assign([
            'data'=>$data,
            'imageFile'=>$imageFile,
            'cate'=>$cate
        ]);

        return  view();
    }

    //删除
    public function delete(){
		 $id = input('param.id');
		 $pid = $this->db->where('pid',$id)->find();
		
        // halt($pid['pid']);
         if ($pid) {
            return json(['valid'=>2,'msg'=>'该栏目有子栏目不允许删除！']);
         }
         if(CategoryModel::destroy($id)){
            return json(['valid'=>1,'msg'=>'删除成功']);
         }else{
            return json(['valid'=>0,'msg'=>'删除失败']);
         }
    }
	
	
	/*
	 * 接收图片上传
	 *  1.通过ajax接收图片。
	 *  2.图片上传验证。
	 *  3.将图片移动到框架应用目录 public/uploads 目录下。
	 *  4.注意：当图片大于2M，由于php.ini配置，会报出一个致命错误。网站上线后需要手动配置。
	 */
	public function upload()
	{
		// 获取上传文件
		$file = request()->file('file');       
		// 验证图片,并移动图片到框架目录下。
		$info = $file->move(ROOT_PATH.'public'.DS.'uploads');
		if($info){
			//
			$path = DS.'uploads'.DS.$info->getSaveName();
		
			// 成功上传后 返回上传信息
			return json(array('state'=>1,'path'=>$path));
		}else{
			// 上传失败返回错误信息
			return json(array('state'=>0,'errmsg'=>'上传失败'));
		}
	}


}
