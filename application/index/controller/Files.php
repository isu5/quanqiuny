<?php
namespace app\index\controller;

use think\Controller;


class Files extends Controller{
	 public function _initialize(){
        parent::_initialize();
        $this->db = model('Files');
    }
	//首页
    public function index()
    {
		
			$data = $this->db->getAll();
			$this->assign([
				'data'=>$data['list'],
				'page'=>$data['page']
				]);
			
		
		return view();
			
	}
	
	//
	public function show(){
		
		$data = $this->db->getOne(input('param.id'));
		$this->assign('data',$data);
		return view();
	}

	//二维码
	public function erwei($id){
		//qrcode($id);
		
		
		scQRcode($id);
	}
	
		//下载
	public function download()
    {
		$id = input('param.id');
		
        $file = db('Files')->find($id);
		$filepath = $file['filepath'];
		$filename = $file['filename'];
		$fileext = $file['fileext'];
		
        $file_dir = ROOT_PATH . 'public' . DS . "$filepath";    // 下载文件存放目录
        
        // 检查文件是否存在
        if (! file_exists($file_dir) ) {
            $this->error('文件未找到');
        }else{
            // 打开文件
            $file1 = fopen($file_dir, "r");
			if($fileext == "jpg" || $fileext =="png" || $fileext =="gif" || $fileext =="jpeg"){
				header("Content-Type: image/png"); //指定下载文件类型的
			}else{
				 // 输入文件标签
				Header("Content-type: application/octet-stream"); ////指定下载文件类型的
			}
            Header("Accept-Ranges: bytes");
            Header("Accept-Length:".filesize($file_dir));
            Header("Content-Disposition: attachment;filename=" . $filename .'.'. $fileext);
            ob_clean();     // 重点！！！
            flush();        // 重点！！！！可以清除文件中多余的路径名以及解决乱码的问题：
            //输出文件内容
            //读取文件内容并直接输出到浏览器
            echo fread($file1, filesize($file_dir));
            fclose($file1);
            exit();
        }
    }
}