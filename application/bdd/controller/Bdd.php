<?php
namespace app\bdd\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Bdd extends Controller{
	

	const
	STATUS_FAIL=1,#非正常
	STATUS_NORMAL=2,#正常
	END=true;

	public function _insert(){
		parent::_initialize();
	}
	public function home(Request $request){
		$return=[
			'code'=>2000,
			'msg'=>'成功',
			'data'=>[]
		];
		#判断参数是否为空 
		$params=$request->param();

		if(empty($params)){
			$return=[
 				'code'=>4001, 
 				'msg'=>'参数不能为空',
 				'data'=>[]
			];
			return json($return);
		}
		#banner图的个数
		$num=isset($params['banner_num'])?$params['banner_num']:2;

		$data=[];
		#获取首页顶部广告信息
		$homeTop=Db::query('select id,title,img_url from ad where p_id=? and status =? limit ?',[1,self::STATUS_NORMAL,1]);


		//获取轮播图：
		$lunb=Db::query('select id,title,img_url from ad where p_id=? and status=? limit ?',[2,self::STATUS_NORMAL,$num]);

		$data=[ 
			'home_top'=>$homeTop,
			'lunb'=>$lunb
		];

		$return['data']=$data;

		return json($return);
	}


	public function bdd(){#渲染方法

		$info=Db('fdd')->select();
		return json($info);
	}

	public function select(){#渲染页面
		return $this->fetch();
	}

	public function add(){
		return $this->fetch();
	}

	public function cdd(){
		$arr=[
			'user'=>input('user'),
			'psd'=>input('psd')
		];
		$info=db("fdd")->insert($arr);
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

}


?>	