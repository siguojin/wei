<?php

namespace app\admin\controller;

use think\Controller;

use think\Db;
class User extends Controller{

	protected $beforeActionList=[
	'select',
	'update',
	'delete',
	'index',
	];

	function index(){
		return "这是index的方法";
	}

	function showuser(){

		echo "这是user控制器的showuser方法";
		$arr=['select','update'];
		return json($arr);
	}
	function  update(){

		echo "这是user控制器的update方法";
	}
	function select(){
 
		return "这是user控制器的查看方法";
	}
	
	function delete(){

		echo "这是user控制器的删除方法";
	}
	

	function add(){
		return $this->fetch('aa/view/add.html');

	}

	public function save(){

		$data =[
			
			'users'=>'流星锤',
			'lb'=>'可毛北鼻',
			'cj'=>'傻逼儿子郑涛'
		];
		$re=Db::table('wei')->insert($data);
		if($re){
			return '添加成功';
		}else{
			return '添加失败';
		}


	}


	public function read(){

		$re=Db::table('wei')->select();
		dump($re);


	}


// 	public function update(){

// 	$data =[
			
// 			'users'=>'流星锤',
// 			'lb'=>'可毛北鼻',
// 			'cj'=>'傻逼儿子郑涛'
// 		];

// 		$re=Db::table('wei')->update($data);
// 		if($re){
// 			return"正确";
// 		}else{
// 			echo "错误";
// 		}

// 	}


// 	public function delete(){
// 		$re=Db::table('wei')->delete(56);
// 		if($re){
// 			return "真确";
// 		}else{
// 			return "删除失败";
// 		}
// 	}
// }




?>