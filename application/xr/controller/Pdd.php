<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Pdd extends Controller{
	
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

		if(!isset($params['username']) || empty($params['username'])){
			$return=[
			'code'=>4005,
			'mag'=>'账号为传值成功'
		];
		return json($return);
		}


		if(!isset($params['password']) || empty($params['password'])){
			$return=[
			'code'=>4005,
			'mag'=>'密码为传值成功'
		];

		return json($return);
		}


		//账号
		$username=$params['username'];
		//密码
		$password=$params['password'];

		$info=Db::query("select * from jy_user where username=?",[$username]);
		if(empty($info)){
			$return=[
				'code'=>4001,
				'mag'=>'账号不存在'
			];
			return json($return);
		}else{
			$psd=$params['password'];
			if($psd!=$password){
				$return=[
					'code'=>4002,
					'mag'=>'密码错误，请重新输入'
				];
				return json($return);
			}

			$date=date('Y-m-d H:i:s',time()+3600);
			//加token存入数据库中
			// $info1=Db::query('update jy_user set token=replace(uuid(),"-",""),date=? where username=?',[$date,$username]);
			$info1=Db::query('update jy_user set token=replace(uuid(),"-",""),date=? where username=?',[$date,$username]);
			//渲染token
			
			// $info2=Db::query('select token from jy_user username=?',[$username]);

			$info2=Db::query("select token from jy_user where username=?",[$username]);


			$return['data']['token']=$info[0]['token'];
		}

		return json($return);

	}



	public function bdd(){
		echo '成功';
	}
}