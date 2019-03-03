<?php

namespace app\qb\controller;                                                              

use think\Controller;
use think\Request;
use think\Db;
use app\qb\model\Wei as model;

class Dbdata extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function login()
    {
        
        $username=input('username');
        $psd=input("password");
       
        if(request()->isGet()){
            return $this->fetch();
        }else if(request()->isPost()){
             $model=new model();
            if($model->login($username,$psd)){
                $this->success('登录成功','Dbdata/create');
            }else{
                echo '登录失败';
            }
        }

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
    $model=new model();
        if(request()->isPost()){
            if(is_uploaded_file($_FILES['files']['tmp_name'])){
                $files=request()->file('files');
                $info=$files->move(ROOT_PATH.'public'.DS.'uploads');
                $path=$info->getSaveName();
                 }
                $arr=[
                'users'=>input('users'),
                'lb'=>input('lb'),
                'cj'=>input('cj'),
                'files'=>$path
                ];

                $data=$model->save($arr);
                if($data){
                    return $this->success('增加成功','Dbdata/save');
                }else{
                    echo "添加失败";
                }
        }

                    return $this->fetch();
            }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $model=new model();
        $limit=2;
        $re=$model->paginate($limit);
        return view('save',['re'=>$re]);


    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function goods_add()
    {
        return $this->fetch();
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        $model=new model();
        $id=input('id');


       $da= $model->find($_GET['id'])->toArray();

        if(request()->isPost()){
        $arr=[     
        'id'=>$id,
        'users'=>input('users'),
        'lb'=>input('lb'),
        'cj'=>input('cj')
        ];

          $re=$model->save($arr,['id'=>$id]);
                        if($re){
                     return $this->success('修改成功','Dbdata/save');
                 }else{
                    echo "修改失败";
                 }
   
        }
        return view('update',['fid'=>$da]);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $model=new model();
        $cc=$model->get($_GET['id'])->delete();
        if($cc){
              return $this->success('删除成功','Dbdata/save');
        }else{
            echo "删除失败";
        }
    }
}









