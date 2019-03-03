<?php

namespace app\commen\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\commen\model\Wei as model;
use think\captcha\Captcha;
class Dbdata extends Controller
{
    public function login()
    {
     $username=input('username');
     $psd=input('password');
        if(request()->isGet()){
            return $this->fetch();
        }
        elseif(request()->isPost()){
            $model=new model();
          
            if($model->checklogin($username,$psd)){
            $this->success('登陆成功','Dbdata/index');
                }else{
                    echo "登录失败";
                }
            }
    }

    function add(){
        return $this->fetch();
        // echo 'aaa';
    }


}
