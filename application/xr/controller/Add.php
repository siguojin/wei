<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Add extends Controller{


	public function add(){#添加
		return $this->fetch();
	}



	public function bdd(){#添加办法
		$arr=[
			'user'=>input("user"),
			'psd'=>input("psd"),
		];

		$info=db("fdd")->insert($arr);

		if($info){
			$return=[
			'code'=>1,
			'msg'=>"添加成功"
		];
		}else{
			$return=[
				'code'=>2,
				'msg'=>'添加失败'
			];
		}

		return json($return);

	}

	public function cdd(){#渲染
		return $this->fetch();
	}

	public function edd(){#渲染方法
		$list=db('fdd')->select();
		return json($list);

	}

	
	public function clcl(){#单行删除
		
		$id=$_POST['id'];
		$list=db('fdd')->delete($id);
		if($list){
			$return=[
				'code'=>'删除成功',
				'age'=>1
			];
		}else{
			$return=[
				'code'=>'删除失败',
				'age'=>2
			];
		}
		return json($return);
	}


	public function sc(){
		$id=$_POST['id'];
		$cd=rtrim($id,',');
		$info=db('fdd')->delete($cd);
		if($info){
			echo 1;
		}else{
			echo 2;
		}

	}

}