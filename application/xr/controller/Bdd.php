<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Bdd extends Controller{
	

public function add(){

	return $this->fetch();

}


public function cdd(){

	$arr=[
		'user'=>input("user"),
		'psd'=>input("psd")
	];
	$info=db("add")->insert($arr);
	if($info){
		$return=[
			'code'=>1,
			'msg'=>'添加成功'
		];
	}else{
		$return=[
			'code'=>2,
			'msg'=>'添加失败'
		];

	}
	return json($return);

}

public function bdd(){
	return $this->fetch();
}

public function edd(){
	$info=db('add')->select();
	return json($info);
}


public function clcl(){

	$id=$_POST['id'];
	$info=db('add')->delete($id);
	if($info){
		$return=[

		
			'code'=>1,
			'mag'=>'删除成功'
		];
	}else{
		$return=[ 			
			'code'=>2,
			'mag'=>'删除失败'
		];
	}

	return json($return);
}


public function wd(){

	$id=$_POST['id'];
	$info=db("add")->delete($id);
	if($info){
		echo 1;
	}else{
		echo 2;
	}

}


}