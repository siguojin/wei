<?php
namespace app\xm\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Add extends Controller{

	public function cart(){
		return $this->fetch();
	}

	public function index(){
		return $this->fetch();
	}
	// public function 

	public function nav(Request $request){
		//接受请求的参数 
		$params=$request->param();

		//接口返回格式
		$return=[
			'code'=>2000,
			'mag'=>'成功',
			'data'=>[]
		];

		
		//判断参数是否传递
		if(!isset($params['nav_num'])||empty($params['nav_num'])){
			$return=[
				'code'=>4001,
				'mag'=>'参数不全'
			]; 
			return json($return);
		}

		//限制导航栏的条数
		$num=$params['nav_num'];

		// //查询导航栏的数据
		$nav_list=Db::query('select id,name,url from jy_nav limit ? ',[$num]);

		$return['data']=$nav_list;

		return json($return);
	}


	public function banner(Request $request){
		//跟post一样接受请求的参数
		$params=$request->param(); 

		//接口返回格式
		$return=[
			'code'=>2000,
			'mag'=>'成功',
			'data'=>[]
		];

		//判断参数是否传递
		if(!isset($params['b_num'])||empty($params['b_num'])){
			$return=[
				'code'=>4001,
				'mag'=>'参数不存在'
			];
			return json($return);
		}

		//限时banner输出的参数
		$num=$params['b_num'];

		//查询banner图的数据
		
		// $list=Db::query('select name,image_url,url from jy_ad where cate_id = 1 limit ? ',[$num]);
		$list=Db::query('select name,image_url,url from jy_ad where cate_id = 1 limit ? ',[$num]);

		$return['data']=$list; 

		return json($return);
		
	}


	public function goods(Request $request){

		$params=$request->param();

		$return=[
			'code'=>2000,
			'mag'=>'成功',
			'data'=>[]
		];

		//判断参数是否传递
		if(!isset($params['g_num']) || empty($params['g_num'])){
			$return=[
				'code'=>4001,
				'mag'=>'参数不全'
			];
			return json($return);
		}

		if(!isset($params['tags']) || empty($params['tags'])){
			$return=[
				'code'=>4002,
				'mag'=>'参数不全'
			];
			return json($return);
		}

		$num=$params['g_num'];   //限制数量

		$tags=$params['tags'];  //类别

		$goods=Db::query('select id,goods_name,goods_image,shop_price,level,market_price from jy_goods where tags= ? limit ?',[$num,$tags]);


		$return['data']=$goods;

		return json($return);

	}



}             