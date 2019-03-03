<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
class Maker extends Controller
{
    /**
     *
     *
     */
    
    public function infor()
    {

        $table = input('table');//获取无表前缀表名-brand

        $table_schema = config('database.database');//获取数据库名称

        $table_name = config('database.prefix').$table;//获取有表前缀的表名-bage_brand

        $sql = "select table_comment from information_schema.tables where table_schema=? and table_name=?";

        $row = Db::query($sql,[$table_schema,$table_name]);//查询表的注释

        $table_comment = $row[0]['table_comment'];//获取表的注释名称

        $sql = "select column_name,column_comment from information_schema.columns where table_schema=? and table_name=?";
        $fields = Db::query($sql,[$table_schema,$table_name]);//返回表的所有字段信息

        // dump($table_comment);
        // dump($fields);
        return [
            'comment'=>$table_comment,
            'fields'=>$fields
        ];
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function index()
    {
        return $this->fetch('table');
    }

    /**
     // * 保存新建的资源
     // *
     // * @param  \think\Request  $request
     // * @return \think\Response
     // */
    public function generator()
        {


            $table=input('table');


            $comment=input('comment');


            $fields=input('fields/a',[]);


            //生成控制器
            $this->makeController($table,$comment);
            //生成模型
            $this->makeModel($table);
            #生成控制器
            $this->makeValidate($table);
            #生成查看视图页面
            $this->makeViewIndex($table,$comment,$fields);
            #生成设置视图页面
            $this->makeViewSave($table,$comment,$fields);
        }




    private function makeController($table, $comment)
    {
        $template = file_get_contents(APP_PATH . 'admin/view/codetemplate/controller.tpl');
        $controller = $model = implode(array_map('ucfirst', explode("_",$table)));
        $title = $comment;
        $search = ['%controller%', '%title%', '%model%'];
        $replace = [$controller, $title,$model];
        $content = str_replace($search, $replace, $template);
        $file = APP_PATH . 'admin/controller/' . $controller . '.php';
        file_put_contents($file, $content);
        echo $file . '控制器生成成功<br>';
    }


    private function makeModel($table)
    {
        $template = file_get_contents(APP_PATH . 'admin/view/codetemplate/model.tpl');
        $model = implode(array_map('ucfirst', explode("_", $table)));
        $search = ['%model%'];
        $replace = [$model];
        $content = str_replace($search, $replace, $template);
        $file = APP_PATH . 'admin/model/' . $model . '.php';
        file_put_contents($file, $content);
        echo $file . '模型生成成功<br>';
    }


    private function makeValidate($table)
    {
        $template = file_get_contents(APP_PATH . 'admin/view/codetemplate/validate.tpl');
        $model = implode(array_map('ucfirst', explode("_",  $table)));
        $search = ['%model%'];
        $replace = [$model];
        $content = str_replace($search, $replace, $template);
        $file = APP_PATH . 'admin/validate/' . $model . '.php';
        file_put_contents($file,$content);
        echo $file . '验证器生成成功<br>';
    }


    private function makeViewIndex($table, $comment, $fields)
    {
        $list_head_template = file_get_contents(APP_PATH . 'admin/view/codetemplate/list_head.tpl');
        $list_body_template = file_get_contents(APP_PATH . 'admin/view/codetemplate/list_body.tpl');
        $list_head = $list_body = '';
        foreach ($fields as $field) {


            $search = ['%field_comment%', '%field_name%'];
            $replace = [$field['comment'], $field['name']];
            $list_head .= str_replace($search, $replace, $list_head_template);
            $list_body .= str_replace($search, $replace, $list_body_template);


        }
        $template = file_get_contents(APP_PATH . 'admin/view/codetemplate/list.tpl');
        $search = ['%title%', '%list_head%', '%list_body%'];
        $replace=[$comment,$list_head,$list_body];
        $content = str_replace($search, $replace, $template);
        if (!is_dir(APP_PATH . 'admin/view/' . $table)){
            mkdir(APP_PATH . 'admin/view/' . $table);
         }
        $file=APP_PATH.'admin/view/'.$table.'/index.html';
        file_put_contents($file,$content);
        echo $file.'查看视图文件生成成功';
    }
    private function makeViewSave($table, $comment, $fields)
    {
        $template = file_get_contents(APP_PATH . 'admin/view/codetemplate/set_list.tpl');
        $set_list='';
        foreach ($fields as $field) {


            $search = ['%field_comment%', '%field_name%'];
            $replace = [$field['comment'],$field['name']];
            $set_list .= str_replace($search, $replace, $template);
        }
        $template=file_get_contents(APP_PATH . 'admin/view/codetemplate/set.tpl');
        $search = ['%title%', '%field_set%'];
        $replace=[$comment,$set_list];
        $content = str_replace($search, $replace, $template);
        if (!is_dir(APP_PATH . 'admin/view/' . $table)){
            mkdir(APP_PATH . 'admin/view/' . $table);
        }
        $file=APP_PATH.'admin/view/'.$table.'/save.html';
        file_put_contents($file,$content);
        echo $file.'设置视图文件生成成功';
    }

}
