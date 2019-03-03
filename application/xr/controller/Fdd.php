<?php
namespace app\xr\Controller;
use think\Controller;
use think\Db;
use think\Request;


class Fdd extends Controller{
	

	public function add(){
		
		if(!$_POST){
			return $this->fetch();
		}else{
			// $arr=[
			// 	'user'=>input('user'),
			// 	'psd'=>input('psd'),
			// 	'phon'=>input("phon"),
			// 	'sex'=>input("sex")
			// ];
			// $info=db("bdd")->insert($arr);#用框架添加
				$user=input("user");#传过来的用户名
				if(!$user){
					$return=[
						'code'=>3,
						'mag'=>'用户民不能为空'
					];die;
				}
				$psd=input("psd");#传过来的密码
				if(!$user){
					$return=[
						'code'=>4,
						'mag'=>'密码不能为空'
					];die;
				}

				$phon=input("phon");#传过来的手机号
				if(!$user){
					$return=[
						'code'=>5,
						'mag'=>'手机号不能为空'
					];die;
				}

				$sex=input('sex');
				if(!$user){
					$return=[
						'code'=>3,
						'mag'=>'用户民不能为空'
					];die;
				}

	$info = Db::execute("insert into jy_bdd (user,psd,phon,sex) values ('$user','$psd','$phon','$sex')");#原生sql
		#value后面的必须加引号包起来，添加渲染需要的是execute
				if($info){
					$return=[
						'code'=>1,
						'mag'=>'添加成功'
					];

				}else{
					$return=[
						'code'=>2,
						'mag'=>'添加失败'
					];
				}
				print_r(json_encode($return));
		}
	}

	public function bdd(){
		return $this->fetch();
	}

	public function cdd(){
		// $info=db("bdd")->select();#框架查询

		// $info=DB::query("select * from jy_bdd");#查询全部
		// $info=DB::query("select id,user from jy_bdd where 1");#查询字段
		// $info=DB::query("select * from jy_bdd where psd=1234567");#查询条件相等的
		// $info=DB::query("select * from jy_bdd where id<>4");#查询不等于的
		// $info=DB::query("select * from jy_bdd where id in(1,5)");#查询id位1根5的数据
		$info=DB::query("select * from jy_bdd not in (2,3)");
		
		return json($info);
	}

}
?>
