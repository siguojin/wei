<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Log;


class Tdd extends Controller{
	
	public function add(){
		return $this->fetch();
	}


	public function doSign(Request $request){
		//接受传递的参数
		$params=$request->param();

		$return=[
			'code'=>2000,
			'msg'=>"签到成功",
			'data'=>[]
		];

		//是否传递用户id
		if(!isset($params['user_id']) || empty($params['user_id'])){
			$return=[
				'code'=>4001,
				'msg'=>"用户ID不能为空"
			];
			return json($return);
		}

		$userId=$params['user_id'];

		//获取今天的日期
		$today=date('Y-m-d');

		//echo $today;exit;

		//根据当前用户id查询数据
		
		$sign1=Db::query("select * from jy_info where user_id= ?",[$userId]);

		//print_r($sign1);exit;

		if(!empty($sign1)&& $sign1[0]['last_date']==$today){//数据库不能为空，代表重复签到

			$return=[
				'code'=>4001,
				'msg'=>"你好，你已经签到成功,请明天再来"
			];

			Log::info("你好，你已经签到成功,请明天再来");

			return json($return); 
		}

		// $sign2=Db::query("select * from jy_info where user_id",[$userId]);
		
		if(empty($sign1)){
			Db::query("insert into jy_info (user_id,c_days,total_scores,total_days,last_date) values(?,?,?,?,?)",[$userId,1,1,1,$today]);

			$return['data']['score']=1;
			Log::info("第一次签到的时候");

			return json($return);
		}else{
			//昨天的日期
			$last_day=date("Y-m-d",time()-3600*24);
			if($last_day==$sign1[0]['last_date']){//连续签到 

				//连续签到的天数
				$c_days=$sign1[0]['c_days']+1;
				Log::info("连续签到的时候");

			}else{
				$c_days=1; 
				Log::info("非连续签到的时候");
			}
			$total_scores=$sign1[0]['total_scores']+$c_days;

			$total_days=$sign1[0]['total_days']+1;

			Db::query('update jy_info set c_days=?, total_scores=?,total_days=?,last_date=? where user_id=?',[$c_days,$total_scores,$total_days,$today,$userId]);

			$return['date']['score']=$c_days;

			return json($return);

		}

	}

//签名渲染
	public function bdd(){
		$sign_list=Db::query("select * from jy_info");
		// $return=[
		// 	'code'=>2000,
		// 	'msg'=>"签到成功",
		// 	'data'=>[]
		// ];

		return json($sign_list);

	}
	
}