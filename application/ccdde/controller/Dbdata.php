<?php

namespace app\ccdde\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\ccdde\model\Wei as model;

class Dbdata extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页. 
     *
     * @return \think\Response
     */
    public function add()
    {
            if(request()->isPost()){
             $model = new model();

  // if(is_uploaded_file($_FILES['files']['tmp_name']))
            // {
 //    $files = request()->file('files');
            //     $info=$files->move(ROOT_PATH.'public'.DS.'uploads');
            //     $path=$info->getSaveName();
            // }


            if(is_uploaded_file($_FILES['files']['tmp_name'])){//判断他
                $files=request()->file('files');//用files接受
                $info=$files->move(ROOT_PATH.'public'.DS.'uploads');//
                $path=$info->getSaveName();
            }



            $arr=[
                'users'=>input('users'),
                'lb'=>input('lb'),
                'cj'=>input('cj'),
                'files'=>$path
            ];

            $re=$model->save($arr);
            if($re){
                $this->success('添加成功','Dbdata/save');
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();
    
    }
    // public function add(){
    //     return $this->fetch();
    // }



    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {   
            $model=new model();
            $limit=1;
            $re= $model->paginate($limit);
            return view('save',['re'=>$re]);
    }


    public function delete(){
        $model=new model();
        $data=$model->get($_GET['id'])->delete();
        if($data){
            $this->success('删除成功','Dbdata/save');
        }else{
            echo "删除成功";
        }

    }

    public function update()
    {
        $model=new model();
        $id=input('id');
        $da=$model->find($_GET['id'])->toArray();

        // dump($da);die;
        if(request()->isPost()){

            $data=[
                'id'=>$id,
                 'users'=>input('users'),
                 'lb'=>input('lb'),
                 'cj'=>input('cj')
                 ];
                 $re=$model->save($data,['id'=>$id]);
                 if($re){
                    $this->success('修改成功','Dbdata/save');
                 }else{
                    echo "修改失败";
                 }
        }
         // return view('update',['fid'=>$da]);
         return view('update',['fid'=>$da]);


    }


}
