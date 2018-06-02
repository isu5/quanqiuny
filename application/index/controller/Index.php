<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {

    	$data = db('category')->order('sort desc, id desc')->select();
    	
    	getTree();
        return view();
    }
}
