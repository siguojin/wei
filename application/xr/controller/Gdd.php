<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Gdd extends Controller{
	
	public function _initialize(){
      		  parent::_initialize();
  	  }
	public function add(){
		return $this->fetch();
	}

	public function bdd(){

		    $file = request()->file('files');   
    		// 移动到框架应用根目录/public/uploads/ 目录下
    		   $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
  		  $path=$info->getSaveName(); 
		    $user=input("user");
		    // $array=[
		    // 	'files'=>$path,
		    // 	'user'=>$user
		    // ];

	    $info=Db::execute("insert into jy_cdd (files,user) values ('$path','$user')");
		    // $info=db("cdd")->insert($array);
		    if($info){
		    	$this->success("添加成功",'add');
		    }else{
		    	$this->error("添加失败",'add');
		    }
	}


	public function cdd(){
		$info=DB::query("select * from jy_add");
		return json($info);		

	}
}

?>