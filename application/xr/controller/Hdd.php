<?php
namespace app\hdd\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Hdd extends Controller{

	public function checSign(Request $request){

		if(isset($params['sign'] )|| empty($params['isgn'])){
			echo "sign签名不能为空";
		}
		$sign=$params['sign'];
		unset($params['sign']){
			$string=http_build_query($params);
			$sercet=$this->sercet;
			$new_sign=md5($string.$sercet);//重新生成签名
			if($new_sign!==$sign){
				echo "签名不合法或者签名错误";exit;
			}
			echo 'sign签名验证成功';
		}


	}

	public function Login(Request $request){
		$params=$request->param();//获取接口请求的所有参数
		//用户民
		$username=$params['username'];

		$password=$params['password'];

$user=Db::query('select * from user where username = ? and  password= ? ',[$username],$password);
	
	if(!empty($username)){
		$userId=$user[0]['id'];
		Db::query('update user set token replace (uuid(),"-"," "),expired_at = ? wh id =?',[time()+30,$userId] );
	}
	$return -[
		'msg'="登陆成功",
		'data'=>[
		'token'=>$user[0]['token']
		]
	];

	echo json_encode($return);exit;
	}






	public function checkToken(Request $request){
		$params=$Request->param();
		if(!isset($params['token']) || empty($params['token'])){
			echo "token不存在或者为空";
		}
		$token=$params['token'];
		$data=Db::query("select id,token, expired_at from user wh  token = ?" [$token]);
		if(empty($data)){
			echo "token值不合法";exit;
		}
		if($data[0]['expired_at']<time()){
			echo 'token已经过期';exit;
		}
		echo 'token验证成功'

	}





















}