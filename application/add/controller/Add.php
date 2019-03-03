<?php
namespace app\add\controller;
use think\Controller;
class Add extends Controller{
    public function add()
    {
        return $this->fetch();
    }

    public function bdd(){
    $file = request()->file('files');   
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    $path=$info->getSaveName(); 
    	$array=[
    		'user'=>input('user'),
    		'psd'=>input('psd'),
    		'files'=>$path

    	];
    	 $info=db('wei')->insert($array);
    	if($info){
    		$this->success('添加成功','cdd');
    	}else{
    		$this->error('添加失败');
    	}

    }


    public function cdd(){
    	$info=db('wei')->select();
    	$this->assign('info',$info);
    	return $this->fetch();
    }

    public function delete(){
          $id=input('id');
    	$info=db('wei')->delete($id);
    	if($info){
    		$this->success('删除成功','cdd');
    	}else{
    		$this->error('删除失败');
    	}
    }

    public function update(){
    		$id=input('id');
    		$info=db("wei")->find($id);
    		$this->assign("info",$info);
    		return $this->fetch();
    }

    public function upload(){

    	$array=[
    	
    		'user'=>input('user'),
    		'psd'=>input('psd')

    	];
    	$id=input('id');
    	
    	$info=db('wei')->where('id',$id)->update($array);
    	if($info){
    		$this->success('修改成功','cdd');
    	}else{
    		$this->error("修改失败");
    	}


    }


}


?>