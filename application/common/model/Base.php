<?php

namespace app\common\model;

use think\Model;
use third\Data;

class Base extends Model
{
     /**
     * 获取全部数据
     * @param  string $type  tree获取树形结构 level获取层级结构
     * @param  string $order 排序方式   
     * @return array         结构数据
     */
    public function getTree($type='tree',$order='',$name='catename',$child='id',$parent='pid'){
        
       // 判断是否需要排序
        if(empty($order)){
            $data=$this->select();
        }else{
            $data=$this->order($order.' is null,'.$order)->select();
        }
        // 获取树形或者结构数据
        if($type=='tree'){
            $data= Data::tree($data,$name,$child,$parent);

        }elseif($type="level"){
            $data= Data::channelLevel($data,0,'&nbsp;',$child);
        }
        return $data;
    }

    //测试
    public function test(){
       return '1233123';
    }



}
