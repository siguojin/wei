<?php
//header("content-type:text/html;charset=utf8");

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\admin\model\Wei as model;
use app\admin\model\Cc as model;

class Dbdata extends Controller
{
    function login(){
        if(request()->isGet()){
            return $this->fetch();
        }
    }


    public function add()
    {
        header("content-type:text/html;charset=utf8");
      
     if (request()->isPost()) {
        $model = new model();
    if(is_uploaded_file($_FILES['files']['tmp_name'])){
    $file = request()->file('files');   
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    $path=$info->getSaveName(); 
    // if(is_uploaded_file($_FILES['files']['tmp_name'])){
    //     $files=request()->file('files');
    //     $info=$file->move(ROOT_PATH.'public'.DS.'uploads');
    //     $path=$info->GetSaveName();
    // }
    // }
    
            $arr = [
                'users'=>input('users'),
                'lb'=>input('lb'),
                'cj'=>input('cj'),
                'files'=>$path
            ];
            $re = $model->save($arr);
            if ($re) {
                $this->success('添加成功','Dbdata/create');
            }else{
                $this->error('添加失败');
            }
        }
         return $this->fetch();
    }
}

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
     function create()
    {
        $limit=3;
         $model = new model();
        $re = $model->paginate($limit);
        return view('cdd',['re'=>$re]);
    }

   

  
    // public function delete()
    // {
    //     $model = new model();
    //     $re = $model->find($_GET['id'])->delete();
    //      if($re){
    //           $this->success('删除成功','Dbdata/create');
    //      }else{
    //          return "删除失败";
    //      }
    // }




    // public function update(){
    //    $model = new model();
    //    $id=input('id');
    //     $da = $model->find($_GET['id'])->toArray();
    //     if (request()->isPost()) {
            
    //         $data =[
    //             'id'=>$id,
    //              'users'=>input('users'),
    //              'lb'=>input('lb'),
    //              'cj'=>input('cj')
    //          ];
    //          $re = $model->save($data,['id'=>$id]);
    //          if($re){
    //              $this->success('修改成功','Dbdata/create');
    //          }else{
    //             echo "修改失败";
    //          }
    //     }
    //      return view('update',['fid'=>$da]);
       
    // }


    }
}
