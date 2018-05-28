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
        return $this->fetch();
    }
}
