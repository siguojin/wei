<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;

class Jdd extends Controller{


	public function login(){
		return $this->fetch();
	}

	public function add(Request $request){

		//接受传过来的值
		$params=$request->param();

		$return=[
			'code'=>2000,
			'mag'=>'成功',
			'data'=>[]
		];

		//检验用户是否传过来
		if(!isset($params['phone']) || empty($params['phone'])){
			$return=[
				'code'=>4001,
				'mag'=>'用户名不存在'
			];
			return json($return);
		}

		//检验用户是否传过来
		if(!isset($params['password']) || empty($params['password'])){
			$return=[
				'code'=>4001,
				'mag'=>'密码不存在'
			];
			return json($return);
		}

		//账号
		$phone=$params['phone'];
		//密码
		$password=$params['password'];

		$info=Db::query("select * from jy_user where phone= ? ",[$phone]);

		if(empty($info)){
			$return=[
				'code'=>4002,
				'mag'=>'用户组没有传过来'
			];
			return json($return);
		}else{

			$psd=$password;

			$psda=$info[0]['password'];

			if($psda!==$psd){
				$return=[
				'code'=>4003,
				'mag'=>'密码不正确'
			];
			return json($return);
			}


			$date=date("Y-m-d H:i:s",time()+3600);
			//生成token存放数据库
			$info1=Db::query('update jy_user set token=replace(uuid(),"-",""),date=? where username=?',[$date,$username]);
			$info2=Db::query("select token from jy_user where username= ?",[$username]);
			$return['data']['token']=$info[0]['token'];
		}


		return json($return);


	}


	public function bdd(){

		return $this->fetch();
	}

	public function cdd(Request $request){
		//接受传过来的参数
		$params=$request->param();

		$return=[
			'code'=>2000,
			'mag'=>'登录成功',
			'data'=>[]
		];
		//判断账号是否传值
		// if(!isset($params['username']) || empty($params['username'])){
		// 	$return=[
		// 		'code'=>4001,
		// 		'mag'=>'用户名不存在'
		// 	];
		// 	return json($return);
		// }

		// //检验用户是否传过来
		// if(!isset($params['password']) || empty($params['password'])){
		// 	$return=[
		// 		'code'=>4001,
		// 		'mag'=>'密码不存在'
		// 	];
		// 	return json($return);
		// }


		//账号
		$username=$params['username'];
		//密码
		$password=$params['password'];

		

		$info=Db::query("select * from jy_user where username= ?",[$username]);

		if(empty($info)){
			$return=[
				'code'=>4001,
				'mag'=>"账号不存在"
			];

			return json($return);
		}else{
			$psd=$info[0]['password'];
			if($psd!=$password){
				$request=[
					'code'=>4002,
					'mag'=>'密码不正确',
				];
				return json($return);
			}

			$date=date("Y-m-d H:i:s",time()+3600);
			//生成token存进去
			$info1=Db::query('update jy_user set token=replace(uuid(),"-",""),date=? where username=?',[$date,$username]);

			//查询token
			$info2=Db::query('select token from jy_user where username=?',[$username]);
			$return['data']['token']=$info[0]['token'];

		}

		return json($return);
			


	}



	public function edd(Request $request){
		$params=$request->param();


		$return=[
			'code'=>2000,
			'mag'=>'登录成功',
			'data'=>[]
		];

		//判断账号是否传值
		if(!isset($params['username']) || empty($params['username'])){
			$return=[
				'code'=>4001,
				'mag'=>'用户名不存在'
			];
			return json($return);
		}

		//检验用户是否传过来
		if(!isset($params['password']) || empty($params['password'])){
			$return=[
				'code'=>4001,
				'mag'=>'密码不存在'
			];
			return json($return);
		}


		$username=$params['username'];
		//密码
		$password=$params['password'];

		$info=Db::query("select * from jy_user where username= ?",[$username]);
		// $info=Db::query("select * from jy_user where username= ?",[$username]);

		if(empty($info)){
			$return=[
				'code'=>4001,
				'mag'=>"账号不存在"
			];

			return json($return);
		}else{

			$psd=$info[0]['password'];
			if($psd!=$password){
				$return=[
					'code'=>4002,
					'mag'=>'密码不正确'
				];	
				return json($return);
			}

			$date=date('Y-m-d H:i:s',time()+3600);
			//token添加进去
			$info1=Db::query('update jy_user set token=replace(uuid(),"-",""),date=? where username=?',[$date,$username]);

			//token渲染
			$info2=Db::query("select token from jy_user where username=?",[$username]);
			$return['data']['token']=$info[0]['token'];

		}

		return json($return);

	}
}