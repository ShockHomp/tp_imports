<?php
namespace app\index\controller;
use think\View;
use think\Controller;
class User extends controller
{
//控制器首先执行 _ininialize 方法
	public function _initialize()
    {
        echo 'init<br/>';
    }
	public function index(){
		// dump('this s index');
		//方法一
		// $view=new View();
		// return $view->fetch('index');
		//方法二
		// return view('index');
		// return ['name'=>'thinkphp','status'=>1];
		// return 'hello user/index';

		// $this->error('新增失败');
		// $this->success('新增成功','User/index','返回数据','2');
		$this->redirect('User/getPhone', ['cate_id' => 2,'cate_name'=>'分类名称']);
	}
    public function getPhone()
    {
    	return '新增成功，跳转这里';
    }
    public function getInfo()
    {
    	dump('getInfo');
    }
    public function getYear(){
    	dump('getYear');
    }
     public function postInfo()
    {
    }
    
    public function putInfo()
    {
    }
    
    public function deleteInfo()
    {
    }
    public function miss(){
    	return 'this is miss';
    }
    //前置操作
    protected $beforeActionList=[

    	'first',
    	'second'=>['except'=>'hello'],
    	'three'=>['only'=>'hello,data'],
    ];

     protected function first()
    {
        echo 'first<br/>';
    }
    
    protected function second()
    {
        echo 'second<br/>';
    }
    
    protected function three()
    {
        echo 'three<br/>';
    }

    public function hello()
    {
        return 'hello';
    }
    
    public function data()
    {
        return 'data';
    }
 public function _empty($name){
 	return $this->showCity($name);
 }
   //注意 showCity方法 本身是 protected 方法
    protected function showCity($name)
    {
        //和$name这个城市相关的处理
         return '当前城市' . $name;
    }



}
