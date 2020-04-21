<?php
namespace app\index\controller;

use think\View;
use think\Controller;
use app\index\model\User as test;
// use app\index\model\New;
use think\Request;
use think\db\Query;

class User extends controller
{
//控制器首先执行 _ininialize 方法
	public function _initialize()
    {
        // echo 'init<br/>';
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
		// $this->redirect('User/getPhone', ['cate_id' => 2,'cate_name'=>'分类名称']);
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
    // protected $beforeActionList=[

    // 'first',
    // 'second'=>['except'=>'hello'],
    // 'three'=>['only'=>'hello,data'],
    // ];

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


 public function test(Request $request)
 {
    $query = new \think\db\Query();
    $user = model('User');

    // $data = $user::scope('thinkphp,user_id')->paginate(5);
    // useGlobalScope true 开区全局查询，false 关闭全局查询
    // $data = $user::useGlobalScope(true)->where('user_name','thinkphp')->paginate(5); 


         // 查询name = 'thinkphp',score>80且status = 1 并且只查询 id 和 name 两个字段的数据
        // $data = $user::scope('user_id')->where('user_age',0)->paginate(5);  // 查询name = 'thinkphp',score>80且status = 1 并且只查询 id 和 name 两个字段的数据

    // dump($data);
    //调用 用这种形式

    $logic= \think\Loader::model('User','logic');
    // echo $logic->index();
    // 转换为数组
    // 可以使用toArray方法将当前的模型实例输出为数组，例如：

    $user = Test::get(81);
    // dump($user->toArray());
    //不输出字段属性
    // dump($user->hidden(['user_json','user_ip'])->toArray());
    // echo $user->user_age;
    // echo $user->new->user_id;
    // $data = \think\Loader::model('User')->get(2)->new;
    // dump($user->append(['status_text'])->toArray());

    // $logic::where('user_name','thinkphp')->paginate(5); 

    // $this-> assign('data',$data);

        // return $this->fetch('User/test',['name'=>'thinkphp']);   // 渲染到模板后跟Db查询方法一样使用
        // return view('User/test',['name'  => 'ThinkPHP',
        //     'email' => 'thinkphp@qq.com']);  
             // 渲染到模板后跟Db查询方法一样使用
    // 要注意模板文件位置是相对于应用的入口文件，而不是模板目录。
       // return $this->fetch('../test.html');
    // return $this -> display('姓名:{$name},课程:{$lesson}',[
    //   'name'=>'Peter',
    //   'lesson'=>'php'
    //   ]);
    \Think\View::share('sex','男');
    $this->assign('name','李容与');    
    
    dump(config("view_replace_str"));
    // dump();
    dump(\think\config::get());
    setcookie('siteName','PHP中文网');
    // return $this->fetch('new/index');//无控制器也可以
    // return $this->fetch('user/test');//无控制器也可以

    //变量调节器
    $this->assign(['domain'=>'www.php.cn','birthday'=>'2345678']);
    // return $this->fetch();

}


}
