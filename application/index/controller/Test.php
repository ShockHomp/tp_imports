<?php
namespace app\index\controller;

use think\View;
use think\Controller;

// use app\index\model\New;
use think\Request;
use think\db\Query;

class Test extends controller
{
    public function test(){
        return "this is test";
    }
    public function demo1($id){
        return 'this is  demo1';
    }
    public function demo2($name){
        return 'this is  demo2';
    }
    public function demo3($isOk){
        return 'this is  demo3';
    }
    public function bd(){
        return 'bind自动绑定';
    }

}
