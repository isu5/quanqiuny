<?php
/**
*  后台首页
*/
namespace app\admin\controller;
use think\Controller;

class Index extends Common
{
    public function index()
    {
		$host = 'http://'.$_SERVER['HTTP_HOST'];
		
		//dump($host);
        return $this->fetch();
    }
}
