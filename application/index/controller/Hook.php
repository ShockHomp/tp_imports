<?php
namespace app\index\controller;

use think\View;
use think\Controller;

// use app\index\model\New;
use think\Request;
use think\db\Query;

class Hook extends controller
{
	public function test(){
		return "this is test";
	}
	public function demo1(){
//		return 'this is  demo1';
        return $this->request->siteName;
	}
	public function demo2(){
//		return 'this is  demo2';
        return  $this->request->names();
	}
	public function demo3(){
		return 'this is  demo3';
	}
	public function bd(){
	    return 'bind自动绑定';
    }

}
