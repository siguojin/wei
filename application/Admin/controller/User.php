<?php
namespace app\Admin\controller;

/*class User{

	function showUser(){

		echo '这是user控制器下的showuser方法！';

	}
	
}*/
 /*namespace app/Admin\controller;
 class User{
 function showUser(){
 	echo "1111";
 }}*/
use think\Controller;
class user extends Controller{

	protected $beforeActionList=[
		'first',
		'second'=>['except'=>'hello'],
		'three'=>['only'=>'hello,data'],
	];

	protected function first(){
		echo 'first<br/>';
	}
	protected function second(){
		echo 'second<br/>';
	}
	protected function three(){
		echo 'three<br/>';
	}
	public function hello(){
		return 'hello';
	}
	public function data(){
		return 'data';
	}
}