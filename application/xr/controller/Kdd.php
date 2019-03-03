<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;

class kdd extends Controller{

	public function add(){
		return $this->fetch();
	}

	public function bdd(){
		$arr=[
			'user'=>input('user'),
			'psd'=>input('psd')
		];
		$info=db("add")->insert($arr);
		if($info){
			$return=[
				'code'=>100,
				'mag'=>"添加成功"
			];
		}else{
			$return=[
				'code'=>200,
				'mag'=>"添加失败"
			];
		}
		return json($return);
	}


	public function edd(){
		$info=db('add')->select();
		return json($info);
	}

	public function cdd(){
		return $this->fetch();
	}

	public function del(){
		$id=$_POST['id'];
		$cd=rtrim($id,',');
		$info=db('add')->delete($cd);
		if($info){
			echo 1;
		}else{
			echo 2;
		}
	}


	

}