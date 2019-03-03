<?php

namespace app\commen\model;

use think\Model;

class Wei extends Model
{
	//表单中的用户民和密码和数据库表中的用户名和密码进行对比是不是相等
    function checklogin($username,$psd){
    	$data=$this->where("users='$username' and lb='$psd' " )->find();
    	if($data){
    		return $data;
    	}else{
    		return null;
    	}

    }
}
