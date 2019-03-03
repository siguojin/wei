<?php
namespace app\ac\controller;
use think\Controller;
class Add extends Controller{

    public function cdd(){

            return $this->fetch();

    }

    public function bdd(){
        // $info=db('fdd')->select();
        $limit=3;
        $info=Db('fdd')->select($limit);
        return json($info);
    }


}


?>