<?php
namespace app\index\controller;

use think\View;
use think\Controller;
use think\Model\User;
// use app\index\model\New;
use think\Request;
use think\db\Query;

class Hook extends controller
{


    /**
     * Hook constructor.
     * @param $request
     */
    protected $request;
    protected $user;//依赖注入 可以直接使用model 类里面的 方法（可以操作数据库表字段）

    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }


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
    //依赖注入
    public function req(Request $request)
    {
        return  '学习课程:'.$request->param('lesson');
    }

}
