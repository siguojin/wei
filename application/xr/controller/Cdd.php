<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Cdd extends Controller{

	public function add(){
		$date=date("Y-m-d H:i:s");
		$arr=[
			'user'=>input("user"),
			'date'=>$date
		];
		$info=db("lyb")->insert($arr);
		if($info){
			$return=[
				'code'=>1,
				'mag'=>'添加成功'
			];
		}else{
			$return=[
				'code'=>2,
				'mag'=>"添加失败"
			];
		}

		return json($return);
	}


	public function select(){
		$info=db('lyb')->select();
		return json($info);
	}



}
?>