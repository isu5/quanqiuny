<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Feeds as Feed;
class Feeds extends Common{

	private $db = null;
    public function _initialize(){
        parent::_initialize();
		$this->db = model('Feeds');
    }
    //账户信息
    public function index(){
		$data = $this->db->getAll();
		
		$this->assign([
            'data'=>$data['list'],
            'page'=>$data['page'],
			'is_invoice'=>input('param.is_invoice' , 2),
            ]);
		
    	return view();
    }
	
	//查看单个信息
	public function show(){
		$id = input('param.id');
		$data = $this->db->getOne($id);
		$this->assign('data',$data);
		return view();
	}
	
	//删除
	 public function delete(){
        $id = input('param.id');
        if(Feed::destroy($id)){
            return json(['valid'=>1,'msg'=>'删除成功']);
        }else{
            return json(['valid'=>0,'msg'=>'删除失败']);
        }
    }
	
	
	//导出开发票的数据
	public function kaiexcle(){
		//$data = $this->db->getAllList();
		$data = db('Feeds')->where(['is_invoice'=>1])->select();

		$info=array(
		'序号', '订阅单位', '订阅联系人', '称呼(1为先生,0为女士)', '电话', '传真', '中文订阅数量', '英文订阅数量', '邮箱', '邮编', '通信地址',
		'是否需要增值税发票(1为是，0为否)', '开票单位', '纳税人识别号', '注册地址', '注册电话', '开户银行', '银行账户', '订阅时间');
		
		//dump($data);die;
		exportExcel($data , "《全球能源互联网》期刊订阅开发票信息 " , $info);
	
	}
	
	//导出不开发票
	public function noexcle(){
		//$data = $this->db->getAllList();
		$data = db('Feeds')->field('id,fcompany,fusername,fsex,fphone,
		fax,fcnnum,fennum,femail,fcode,faddress,is_invoice,company,addtime')->where(['is_invoice'=>0])->select();
		$info=array(
		'序号', '订阅单位', '订阅联系人', '称呼(1为先生,0为女士)', '电话', '传真', '中文订阅数量', '英文订阅数量', '邮箱', '邮编', '通信地址',
		'是否需要增值税发票(1为是，0为否)', '开票单位', '订阅时间');
		//dump($data);die;
		exportExcel($data, "《全球能源互联网》期刊订阅不开发票信息 " , $info);
		
	}
	public function dataexcle(){
		//$data = $this->db->getAllList();
		$data = db('Feeds')->select();
		$info=array(
		'序号', '订阅单位', '订阅联系人', '称呼(1为先生,0为女士)', '电话', '传真', '中文订阅数量', '英文订阅数量', '邮箱', '邮编', '通信地址',
		'是否需要增值税发票(1为是，0为否)', '开票单位', '纳税人识别号', '注册地址', '注册电话', '开户银行', '银行账户', '订阅时间');
		if(empty($data)){
			$this->error('没有数据');
		}else{
			//dump($data);die;
			exportExcel($data , "《全球能源互联网》期刊订阅开发票信息 " , $info);
			
		}	
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}