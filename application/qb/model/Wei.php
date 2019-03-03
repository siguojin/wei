<?php

namespace app\qb\model;

use think\Model;

class Wei extends Model
{
    
    function login($username,$psd){

    	$data=$this->where("users='$username' and lb='$psd'")->find();
    	if($data){
    		return $data;
    	}else{
    		return null;
    	}
    }


}
