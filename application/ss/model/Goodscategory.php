<?php

namespace app\ss\model;

use think\Model;

class Goodscategory extends Model
{
     function getTree(){
     	$rs=$this->select();
     	$re=$this->tree($rs);
     	return $re;
     }

     #list//查看 所有数据  返回二维数组
     #category id 表的主键值。  表的id
     #deep 分的层级数
     private function tree($list,$categoryid=0,$deep=0){
     	static $tr=[];#存储无限极分类的数据
     	foreach ($list as $row) {#遍历所有的数据
     		if($row['parent_id']==$categoryid){#当我们的父id和主键id相等的时候
     			$row['deep']=$deep;#存储层级
     			$tr[]=$row;#存储每个层级的数据
     			$this->tree($list,$row['category_id'],$deep+1);#递归调用
     		}
     	}
     	return $tr;
     }

}
