<?php
namespace app\cdd\controller;
use think\Controller;
class Cdd extends Controller{


	public function add(){

		
		if(request()->isPost()){
		    if(is_uploaded_file($_FILES['files']['tmp_name'])){
		    $file = request()->file('files');   
		    // 移动到框架应用根目录/public/uploads/ 目录下
		    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		    $path=$info->getSaveName(); 
		}
			$arr=[
				'user'=>input('user'),
				'psd'=>input('psd'),
				'files'=>$path
			];
			$data=db('add')->insert($arr);
			if($data){
				$this->success('添加成功','bdd');
			}else{
				$this->error('添加失败');
			}

		}else{
			return $this->fetch();
		}
	}


	public function bdd(){#渲染
		 $limit=2;
     	   $re = db('add')->paginate($limit);
     	   $this->assign('re',$re);
       	return $this->fetch();
	}

	public function delete(){
		$id=$_GET['id'];
		$info=db('add')->delete($id);
		if($info){
			$this->success('删除成功','bdd');
		}else{
			$this->error('删除失败');
		}

	}


}
