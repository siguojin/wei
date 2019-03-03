<?php

namespace app\ss\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\ss\model\Goodscategory as GoodscategoryModel;

class Dbdata extends Controller
{

    public function index(){
  
   		$model= new  GoodscategoryModel();
    		$re=$model->getTree();
    		
    		return $this->fetch('index',['re'=>$re]);
    		
    	

          

    }



}
