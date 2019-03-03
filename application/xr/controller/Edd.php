<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Edd extends Controller{


	public function add(){
		return $this->fetch();
	}

	public function bdd(){
		$arr=[
			'user'=>input('user'),
			'psd'=>input('psd')
		];
		$info=db('add')->insert($arr);
		if($info){
			$return=[
				'code'=>1,
				'mag'=>'添加成功'
			];
		}else{
			$return=[
				'code'=>2,
				'msg'=>'添加失败'
			];
		}
		return json($return);
	}

	public function edd(){
		return $this->fetch();
	}

	public function cdd(){
		$info=db('add')->select();
		return json($info);
	}

	public function cl(){
		$id=$_POST['id'];
		$info=db("add")->delete($id);
		if($info){
			$return=[
				'code'=>1,
				'msg'=>'删除成功'
			];
		}else{
			$return=[
				'code'=>2,
				'msg'=>'删除失败'
			];
		}
		return json($return);
	}

	public function clcl(){
	
		$cd=rtrim($id,',');
		$info=db("add")->delete($cd);
		if($info){
			echo 1;
		}else{
			echo 2;
		}
	}



	public function dl(){#登录
		return $this->fetch();

	}

	public function d(){
		$cd=input('user');
		$psd=input("psd");
		// $info=db("add")->where('user',$cd)->find();
		$info=db("add")->where('user',$cd)->find();
		if($info['user']!=$cd){
			$return=[
				'code'=>2,
				'mas'=>'账号错误'
			];
		}else{
			$return=[
				'code'=>1,
				'mas'=>'账号正确'
			];
		}
		return json($return);

		if($info['psd']!=$psd){
			$return=[
				'code'=>1,
				'mas'=>'密码错误'
			];
		}else{
			$return=[
				'code'=>1,
				'mas'=>'登录正确'
			];
		}
		return json($return);




		// if(empty($info)){
		// 	$return=[
		// 		'code'=>2,
		// 		'mas'=>'账号错误'
		// 	];
		// }else{
		// 	$return=[
		// 		'code'=>1,
		// 		'mas'=>'账号正确'
		// 	];
		// }
		// return json($return);



	}
}
?>