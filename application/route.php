<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

// | Author: liu21st <liu21st@920929621.com/2020/4/22/12hour>

// +----------------------------------------------------------------------

// 设置name变量规则（采用正则定义）
use think\Route;
use think\Request;

// Route::pattern('name','\w+');
// 支持批量添加
Route::pattern([
    'names' => '\w+',
    'id' => '\d+',
]);

// 组合变量的优势是路由规则中没有固定的分隔符，可以随意组合需要的变量规则，例如路由规则改成如下一样可以支持：

// Route::get('item<name><id>','product/detail',[],['name'=>'[a-zA-Z]+','id'=>'\d+']);

// Route::get('item@<name>-<id>','product/detail',[],['name'=>'\w+','id'=>'\d+']);
//第一种方法定义路由
// use think\Route;
// Route::rule('login/:name', 'index/login');
//第二种方法定义路由
// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['Index/index/hello', ['method' => 'get'],'ext' => 'html', ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],
//      // 定义路由的请求类型和后缀
//     'hello/[:name]' => ['index/hello', ['method' => 'get', 'ext' => 'html','cache'=>'3600']],
//      // Route::rule('login/:name', 'index/login'),


// ];
//Route::rule(['new','new/:id'],'index/Index/index');//路由命名标识意义？
//Route::rule('new/:id/[:name]','index/Index/index?status=1&app_id=5');//隐式传入参数在URL不显示
//支持使用路由前置操作，如果行为方法返回false 表示当前路由无效
//Route::get('new/:id','index/index/index',['before_behavior'=>'\app\index\behavior\UserCheck']);
//Route::get('new/:id','index/index/index',['callback'=>'my_check_fun']);//支持回调函数返回
//Route::get('new/:name$','index/index/index',['merge_extra_vars'=>true]);
Route::get("new/:id", "\app\index\model\User@run");// 直接调用类里面的方法
Route::rule('apptest', '\app\Test@test');

//Route::resource('index','index/index');//支持RESTFUR 请求资源路由(相当于在控制器方法内直接建立了7个方法，分别为index,creat,save,read,edit update,delete)
//Route::controller('index','index/index');//给index控制器设置快捷路由 (相当于直接建立了5个路由 getInfo getPhone ,postInfo ,putInfo,deleteInfo)
//Route::any('new/:id/[:name]', 'index/Index/index?status=1&app_id=5', ['method' => 'post|get'], ['ext' => 'html'], ['before_behavior' => '\application\index\behavior\UserCheck']);//隐式传入参数在URL不显示
//Route::alias("index",'index/Index');//可以访问index模块index控制器内的任意方法
Route::rule('index/:id','index/index/index');
Route::rule('index/tp0502','index/index/tp0502');
Route::get("hello/:name/:pwd",function($name,$pwd){
    return 'this is GitHub username :'.$name."<br>"."password:".md5($pwd);
});//定义一些特殊需求，不执行控制器的方法了。
return [
    'test/:id' => ['index/index/indexTest', ['method' => 'post|get'], ['id' => '\w+']]

];//两种形式可以共存
// Route::rule('login/:name', 'index/login');
//Route::rule('test', 'index/Test/test','get');
Route::rule('userTest', 'index/User/test');
//制定类访问在app下面

Route::get('apptestdata', '\app\Test@testdata');
Route::get('myfunc/:lession', function ($lession) {
    // return '网站更新中.....';
    return '网站更新中.....' . $lession;
});
//访问目录下 跳转
Route::rule('demo', '/public/demo.php');
// Route::rule('jumphttp','http://www.baidu.com');
// 通过Route类调用resource方法，定义的路由规则，指向哪一个模块的控制器
// Route::resource('index','index/index');
//上面这条其实等于下面这七条路由

// Route::rule('/index','index/index/index','get');
// Route::rule('/index/create','index/index/create','get');
// Route::rule('/index/save','index/index/save','post');
// Route::rule('/index/:id','index/index/read','get');
// Route::rule('/index/:id/edit','index/index/edit','get');
// Route::rule('/index/:id','index/index/update','put');
// Route::rule('/index/:id','index/index/delete','delete');

//快捷路由
// Route::controller('user','index/User');

// 例如，我们希望使用user可以访问index模块的User控制器的所有操作，可以使用：
// user 别名路由到 index/User 控制器
// Route::alias('user','index/User');
// user 路由别名指向 User控制器类
// Route::alias('users','\app\index\controller\User');

// 路由别名的操作方法支持白名单或者黑名单机制，例如：

// user 别名路由到 index/user 控制器
// Route::alias('user','index/user',[
// 	'ext'=>'html',
//     'allow'=>'index,read,edit,delete',
// ]);
// 或者使用黑名单机制

// user 别名路由到 index/user 控制器
// Route::alias('user','index/user',[
// 	'ext'=>'html',
//     'except'=>'save,delete',
// ]);

// Route::group(['method'=>'get','ext'=>'html'],function(){
//     Route::any('blog/:id','blog/read',[],['id'=>'\d+']);
//     Route::any('blog/:name','blog/read',[],['name'=>'\w+']);
// });
//如果没有匹配到所有的路由，自动找miss路由
// Route::miss('index/user/miss');

// Route::get('bb/:name',function($name){
// // $name = request()->route('name');
// // $name = urldecode($name); 

//     return '闭包调用不用调用控制器'.$name;
// });
// Route::rule('login/:name', 'index/login');

// blog子域名绑定到index模块的blog控制器
// Route::domain('blog','index/blog');
//URL访问地址变化为：
// 原来的URL访问
//http://www.thinkphp.cn/index/blog/read/id/5
// 绑定到blog子域名访问
//http://blog.thinkphp.cn/read/id/5
// 路由器中使用多级控制器
// Route::get('blog/index','index/one.blog/index');
// Route::get('request/:id?/:name?','index/request',['name'  =>  '\w+',
//     'id'    =>  '\d+',]);

//分租访问
//Route::group('demo',[
//    ':id'=>['index/test/demo1',['method'=>"get"],['id'=>'\d{2,4}']],
//    ':name'=>['index/test/demo2',['method'=>'get'],['name'=>'[a-zA-Z]']],
//    ':isOk'=>['index/test/demo3',['method'=>"get"],['isOk'=>'0|1']]
//
//
//]);


//简化路由 (路由分组，简化路由分组)
Route::group('demo', [//分组名称
    ':id' => 'demo1',//路由规则
    ':name' => 'demo2',
    ':isOK' => 'demo3'
], [
    'method' => 'get',//路由参数
    'prefix' => 'index/test/'
], [
    'id' => '\d{2,4}',//变量规则
    'name' => '[a-zA-z]+',
    'isOK' => '0|1'
]);
//闭包函数 访问
//Route::group('demo',function(){
//    Route::get(':id','index/test/demo1',['method'=>"get"],['id'=>'\d{2,4}']);
//    Route::get(':name','index/test/demo2',['method'=>"get"],['name'=>'[a-zA-Z]']);
//    Route::get(':isOk','index/test/demo3',['method'=>"get"],['isOk'=>'0|1']);
//});
//bind 路由自动绑定（绑定命名空间和类的话直接跳过模块配置文件）
//Route::bind("index/test");


