<?php
namespace app\admin\controller;
use think\Controller;
use think\Config;
class Index
{
    public function index()
    {
        return 'Thinkphp Api为接口而生！';
    }

    function getConfig(){
	$re =Config::get('default_timezone');
	echo '默认的时区是:'.$re;
	}

	function getConfigs(){
		$re=config('default_lang');//使用tp5的助手函数
		echo '默认的语言是：'.$re;
	}

	function assBook(){
		$re=config('database');
		echo '<pre>';
		print_r($re);
	}
	function assCon(){
		$re= config('database.database');
		echo '<pre>';
		print_r($re);
	}
}
