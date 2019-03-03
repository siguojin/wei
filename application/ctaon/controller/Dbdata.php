<?php

namespace app\ctaon\controller;

use think\Controller;
use think\Request;
use think\Db;
class Dbdata extends Controller
{

    



    // public function index()
    // {

    //     return $this->fetch();
    // }


    public function add(){

        return $this->fetch();

    }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $data=[
        'users'=>$_POST['users'],
          'age'=>$_POST['age'],
            'phuo'=>$_POST['phuo'],
              'names'=>$_POST['names'],
                'dss'=>$_POST['dss'],
                  'bss'=>$_POST['bss'],
                    'ass'=>$_POST['ass']
        ];

   
        $re=Db::table('adds')->insert($data);
        if($re){
            $this->success('新增成功','Dbdata/save');

            }

    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $ze=Db::table('adds')->select();
        return View('index',['arr'=>$ze]);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */

     public function cdd()
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
