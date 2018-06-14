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

   //@获取子栏目ID号
    private function sonCategoryIds($categoryID)
    {
        //@初始化栏目数组
        $array[] = $categoryID;
        
        do
        {
            $ids = '';
           // $temp = $this->mysql->select('SELECT `id` FROM `pcb_article_category` WHERE `parentID` IN (' . $categoryID . ')');.
		   $where['pid'] = array('in',$categoryID);
			$temp = $this->select();
		   foreach ($temp as $v)
            {
                $array[] = $v['id'];
                $ids .= ',' . $v['id'];
            }
            $ids = substr($ids, 1, strlen($ids));
            $categoryID = $ids;
        }
        while (!empty($temp));

        $ids = implode(',', $array);
        
        return $ids;
    }



}
