<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Admin as AdminModel;
use think\Session;

/**
* class Admin
* 管理员管理控制器
* @package app\admin\controller
*/
class Admin extends Controller
{
    /**
     * 查看列表
     *
     * @return \think\Response
     */
    public function index()
    {   
        $limit = 3;
        $result = AdminModel::paginate($limit);//分页显示
        return $this->fetch('index',['result'=>$result]);
    }

    /**
     * 设置数据-添加修改合并
     * @param $id
     * @return $mix
     */
    public function save($id=null)
    {   
        if(is_null($id)){
             $model = new AdminModel();//实例化模型对象-添加数据
        }
        else{
             $model = AdminModel::get($id);//实例化模型对象-修改数据
        }

        $request = request();

        if($request->isGet()){

            $data = Session::has('data')?Session::get('data'):$model->getData();
            // dump($data);
            // die();
            return $this->fetch('save',[
                    'message'=>Session::get('message'),//获取报错信息
                    'data'=>$data,
                ]);
         }
        elseif($request->isPost()){


            $data = input();//收集表单的数据

            $validate = validate('Admin');//加载验证器

            $ch = $validate->batch()->check($data);

            if(!$ch){
                // dump($ch->getError());报错信息
                $this->redirect('save',[],302,[
                    'message'=>$validate->getError(),
                    'data'=>$data,
                    ]);
            }

            $model->data($data);//收集表单的数据

            $model->save();//保存数据

            $this->redirect('index');

        }
    
    }

    /**
     * 批量删除列表
     *
     * @param  
     * @return mix
     */
    public function multidel()
    {   
        // /a:代表的数组值
        AdminModel::destroy(input('selected/a',[]));
        $this->redirect('index');//重定向查看页面
    }
}
