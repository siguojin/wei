<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;

class Mdd extends Controller{

	public function add(){
		return $this->fetch();
	}
	public function cdd(){	
			$user=input("user");
			$psd=input("psd");
			$phon=input("phon");
			$info=Db::execute("insert into jy_add (user,psd,phon) values ('$user','$psd','$phon')");
			if($info){
				$return=[
					'code'=>1,
					'mag'=>'登陆成功',
					'data'=>[]
				];
			}else{
				$return=[
					'code'=>2,
					'mag'=>'登陆失败',
					'data'=>[]
				];
			}
			return json($return);
	}

	public function bdd(){
		return $this->fetch();
	}
	

	public function edd(){
	header("content-type:text/html;charset=UTF-8");
	  $limit=3;
     	   $info = db('add')->paginate($limit);
     	  return json($info);
	}

}


    