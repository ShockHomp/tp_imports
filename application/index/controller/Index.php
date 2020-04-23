<?php

namespace app\index\controller;

use app\index\model\BuyerUsers;
use think\Request;
use think\cache\driver\Memcache;
use think\Db;
use think\Config;
use think\Url;

//use think\Response;
class Index
{
    public function index()
    {
//	    return config('app_status');
        //获取请求参数配置
//        $request = Request::instance();
//        dump($request->param( ));
//        原生SQL查询第一种
//        $sqlUser=Db::query('select * from shopping_buyer_users where id=?',[4]);
//        $sqlUser=Db::query('select * from shopping_buyer_users where id=:id',['id'=>13]);
//        $sqlUser=Db::query('select * from shopping_buyer_users where id=:id',['id'=>13]);
//        可以使用多个数据库连接，使用
//        Db::connect($config)->query('select * from shopping_buyer_users where id=:id',['id'=>4]);
//查询构造器
//        $sqlUser=Db::table('shopping_buyer_users')->where('id',13)->select();//find()单条数据
//        $sqlUser=db('buyer_users',[],false)->where('id',4)->find();//可以使用db函数
//        dump($sqlUser);
        $query = new \think\db\Query();//使用查询对象的方式进行查询
        $query->table('shopping_buyer_users')->where('id', 13);
//       dump(Db::find($query)) ;
//        Db::table('shopping_buyer_users')->chunk(2, function($users) {
//            // 处理结果集...
//            dump($users);
////            return false;
//        });
        // 查询JSON类型字段 （info字段为json类型）
//        Db::table('shopping_buyer_users')->where('info$.email','thinkphp@qq.com')->find();
        $data = [
            ['openid' => 'ojvXN4q458ffOfDEMph-xJS3cc55', 'shop_id' => '1'],
            ['openid' => 'ojvXN4q458ffOfDEMph-xJS3cc56', 'shop_id' => '2'],
            ['openid' => 'ojvXN4q458ffOfDEMph-xJS3cc57', 'shop_id' => '3'],
            ['openid' => 'ojvXN4q458ffOfDEMph-xJS3cc58', 'shop_id' => '4'],
        ];
//        Db::name('buyer_users')->insertAll($data);//批量添加数据insertAll
        // 添加多条数据
//        dump(db('buyer_users')->insertAll($data));//用助手函数批量添加数据
        //延时更新的操作
//        $updateDb=Db::table('shopping_buyer_users')->where('id', 2409)->setInc('shop_id', 2, 3);
//        dump($updateDb);
        dump(Db::getTableInfo('shopping_buyer_users', 'type'));//获取 表字段类型
        dump(Db::getTableInfo('shopping_buyer_users', 'pk'));//获取主键
        $failEx = Db::name('buyer_users')
            ->where(['shop_id' => 10000])
            ->failException(false)//fetchSql(true) 打印SQL语句或者直接在调试工具里面可以看到SQL语句
            ->select();//（加上false 表示如果数据不存在，返回空数组，不抛出异常）
        dump($failEx);//如果没有数据直接抛出异常 表数据不存在:shopping_buyer_users
        //查询条件 where('字段名','表达式','查询条件'); whereOr('字段名','表达式','查询条件');
//        Db::table('think_user')
//            ->where('name|title', 'like', 'thinkphp%')
//            ->where('create_time&update_time', '>', 0)
//            ->find() //  SELECT * FROM `think_user` WHERE ( `name` LIKE 'thinkphp%' OR `title` LIKE 'thinkphp%' ) AND ( `create_time` > 0 AND `update_time` > 0 ) LIMIT 1
//        $result = Db::table('think_user')->where(function ($query) {
//            $query->where('id', 1)->whereor('id', 2);
//        })->whereOr(function ($query) {
//            $query->where('name', 'like', 'think')->whereOr('name', 'like', 'thinkphp');
//        })->select(); //SELECT * FROM `think_user` WHERE  (  `id` = 1 OR `id` = 2 ) OR (  `name` LIKE 'think' OR `name` LIKE 'thinkphp' )
//        Db::table('think_user')->select(function($query){
//            $query->where('name','thinkphp')
//                ->whereOr('id','>',10);
//        });
//        Db::table('shopping_buyer_users')
//            ->where('shop_id > :shop_id AND openid LIKE :openid ',['shop_id'=>0, 'open_id'=>'ojvXN4q458ffOfDEMph-xJS3cc58%'])
//            ->select();//为了安全起见，我们可以对字符串查询条件使用参数绑定
//        $viewDb=Db::view('buyer_users','id,openid,shop_id')->select();
//        Db::view('User','id,name')
//            ->view('Profile','truename,phone,email','Profile.user_id=User.id')
//            ->view('Score','score','Score.user_id=Profile.id')
//            ->where('score','>',80)
//            ->select();//视图查询更简洁 SELECT User.id,User.name,Profile.truename,Profile.phone,Profile.email,Score.score FROM think_user User INNER JOIN think_profile Profile ON Profile.user_id=User.id INNER JOIN think_socre Score ON Score.user_id=Profile.id WHERE Score.score > 80
//        dump($viewDb);
        //原生更新SQL 采用占位符方式更加安全
        //Db::execute("update think_user set name=:name where status=:status",['name'=>'thinkphp','status'=>1])
        //打印SQL几种方式 select(false) buildSql()
###############
//        Db::listen(function($sql, $time, $explain){
//            // 记录SQL
//            $sql=Db::view('buyer_users','id,openid,shop_id')->select();
//            echo $sql. ' ['.$time.'s]';
//            // 查看性能分析结果
//            dump($explain);
//        });
###############    （监听失败？
//5.0支持存储过程，如果我们定义了一个数据库存储过程sp_query，可以使用下面的方式调用：
//        $result = Db::query('call sp_query(8)');
        //闭包查询方法（推荐使用闭包查询包括两种方法）
        $openid = 'ojvXN4q458ffOfDEMph-xJS3cc58';
        $id = '2407';
//        $bbDb=Db::table('shopping_buyer_users')->select(function($query) use($openid,$id){
//            $query->where('openid',$openid)
//                ->whereOr('id','>',$id);
//        });
        $bbDb = Db::select(function ($query) use ($openid, $id) {
            $query->table('shopping_buyer_users')->where('openid', $openid)->whereOr('id', '>', $id);
        });
        //列多列数据，和数组中键值设置cloumn
        $columnDb = Db::table('shopping_buyer_users')->where('openid', $openid)->column('id,openid,shop_id');
        dump($columnDb);
//        dump($bbDb);
//		return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span styl="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }

    public
    function indexTest()
    {
        return response('this is  index/test');
    }

    public
    function login($name)
    {
        return 'this is login';
    }

    public
    function hello()
    {
        return 'this is hello';
    }

    public
    function request($id = '1', $name = 'lirongyu')
    {
        // return 'request';
        $request = Request::instance()->module('index');
        //获取当前域名
        echo 'domain:' . $request->domain() . '<br>';
        //获取当前入口文件
        echo 'file:' . $request->basefile() . '<br/>';
        //获取当前URL地址，不含域名
        echo 'url:' . $request->url() . '<br/>';
        //获取包含域名的完整URL地址
        echo 'url with domain:' . $request->url(true) . '<br>';
        //获取当前URL地址 不含QUERY_STRING
        echo 'url without query:' . $request->baseUrl() . '<br/>';
        //获取URL访问的ROOT地址
        echo 'root:' . $request->root() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root with domain: ' . $request->root(true) . '<br/>';
        // 获取URL地址中的PATH_INFO信息
        echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
        // 获取URL地址中的PATH_INFO信息 不含后缀
        echo 'pathinfo: ' . $request->path() . '<br/>';
        // 获取URL地址中的后缀信息
        echo 'ext: ' . $request->ext() . '<br/>';
        // 也可以使用助手函数
        // $request = request();
        //上述输出结果
        //       domain:http://localhost
        // file:/TP5/tp_import/public/index.php
        // url:/TP5/tp_import/public/index.php/index/index/request/id/44.html
        // url with domain:http://localhost/TP5/tp_import/public/index.php/index/index/request/id/44.html
        // url without query:/TP5/tp_import/public/index.php/index/index/request/id/44.html
        // root:/TP5/tp_import/public/index.php
        // root with domain: http://localhost/TP5/tp_import/public/index.php
        // pathinfo: index/index/request/id/44.html
        // pathinfo: index/index/request/id/44
        // ext: html

        //设置/获取 模块/控制器/操作名称

        echo "当前模块名称是" . $request->module() . "<br>";
        echo "当前控制器名称是" . $request->controller() . "<br>";
        echo "当前操作名称是" . $request->action() . '<br>';
        echo '请求方法：' . $request->method() . '<br/>';
        echo '资源类型：' . $request->type() . '<br/>';
        echo '访问ip地址：' . $request->ip() . '<br/>';
        echo '是否AJax请求：' . var_export($request->isAjax(), true) . '<br/>';
        echo '请求参数：';
        dump($request->param());
        echo '请求参数：仅包含name';
        dump($request->only(['name', 'id']));
        echo '请求参数：排除name';
        dump($request->except(['name']));
//获取路由信息
        dump($request->route());
        echo '调度信息：';
// dump($request->dispatch());
// 如果某些环境下面获取的请求信息有误，可以手动设置这些信息参数，使用下面的方式：
        $request->root('index.php');
        $request->pathinfo('index/index/hello');
//可以使用has方法来检测一个变量参数是否设置
//  if(isset($request->has('id','get'))){
//  	echo 'has:id';
//  }else{
// 	echo 'id:no';
// };
// 重要：：：如果你的请求的地址参数是以pathinfo形式，这样参数是无法用$_GET去获取的，同样也不能使用系统中的get方法。
        dump(Request::instance()->has('id', 'get'));
// dump($request->has('id?','get'));
        dump(input('id'));
        dump($request->param('id'));
// dump($request->server()) ;
        dump(Request::instance()->get('id'));

// 更改GET变量
        dump(Request::instance()->get(['id' => 10]));
//判断是否为GET请求
        if (Request::instance()->isGet()) echo "当前为 GET 请求" . '<br>';
// 可以使用Request对象的header方法获取当前请求的HTTP 请求头信息
        $info = Request::instance()->header();
        echo $info['accept'] . '<br>';
        echo $info['accept-encoding'] . '<br>';
        echo $info['user-agent'] . '<br>';


    }


    public
    function m4()
    {
        $Cache = new Memcache();
        $Cache->set('test', 'swdss', 3600);  //这是存某个值，后面的3600为有效时间
        // $Cache->add('add','fsfdsfdsfdsfsfafdfaa',3600);  //这是存某个值，后面的3600为有效时间
        // $Cache->replace('test','gggg',3600);  //这是存某个值，后面的3600为有效时间

        $Cache->get('test');                             //获取某个值
        dump($Cache->get('test'));
        //清空缓存

        $Cache->rm('test');                              //删除某个值

        $Cache->clear();
        dump($Cache->get('test'));

    }

    public
    function m88()
    {
        echo '82q';
        $Cache = new Memcache();
        $Cache->set('test', 'fsfdsfdsfdsfsfafdfaa', 3600);
        $val = $Cache->get('test');                             //获取某个值
        // dump($val);
        $Cache->rm('test');                              //删除某个值

        $Cache->clear();
        dump($val);
        // 本身定义变量了,所以清楚缓存变量名字不变。

        //参数基本使用
        $userAll = Db::query("select * from user");
        dump($userAll);
        // foreach($userAll as $k=>$v){
        // 	dump($v);
        // }
        // Db::execute('insert into think_user (id, name) values (?, ?)',[8,'thinkphp']);
        // Db::execute("insert into user (user_id,user_name) values(?,?)",[3,'liyufeng']);
        // 更新记录
        $id = 3;
        // Db::execute('update user set user_name = "liyufengs" where user_id = ?',[$id]);
        //删除操作
        Db::execute('delete from user where user_name=:user_name', ['user_name' => 'liyufeng']);

        //参数基本使用
    }

    public
    function search()
    {
        // table方法必须指定完整的数据表名
        // $findDb=Db::table('user')->where('user_id',1)->find();
        // dump($findDb);
        // // 查询数据集使用：

        // $selectDb=Db::table('user')->where('user_name','not null')->select();
        // dump($selectDb);

        // $data = ['user_name' => 'bar'];
        // Db::table('user')->insert($data);
        // 	$data = ['user_name' => 'bara', 'user_age' => '1'];
        // 	Db::table('user')
        // 	->readMaster()
        // 	->insert($data);
        // 	Db::table('user')->insert($data);
        // $masterDb=Db::name('user')->select();
        // 	dump($masterDb);
        // 使用Query对象或闭包查询
        $query = new \think\db\Query();
        // $query->table('user')->where('user_age',1);
        // dump(Db::find($query));
        // dump(Db::select($query));
        // Db::select(function($query){
        // $all=$query->table('user')->where('user_age',1);
        // dump($all);
        // dump(Db::table('user')->where('user_age',1)->column('user_name'));
        // dump(Db::table('user')->where('user_age',1)->column('user_name','user_id'));
        // dump(Db::table('user')->where('user_age',1)->column('user_id,user_name'));

// 或者交给回调方法myUserIterator处理
        // dump(Db::table('user')->chunk(100, 'myUserIterator'));
        // Db::table('user')->chunk(2, function($users) {
        // // 处理结果集...
        // 	dump($users);
        // 	// return false;
        // });

        // 也支持在chunk方法之前调用其它的查询方法，例如：

        Db::table('user')->chunk(2, function ($users) {
            foreach ($users as $user) {
                // dump($users);
                dump($user['user_id']);
                if ($user['user_id'] == 2) {
                    return false;
                }
            }
        });
        // json_extract 受mysql 版本支持影响(低版本不支持)
        // SELECT * FROM core_process where Form_Value_ -> '$.attendancer' = '马立新'
        // $userAll=Db::query("select json_extract(user_json,'$.attendancer') from user");
// select json_extract(data,'$.name') from tab_json
// {'attendancer':"马立新"}

        // $data = ['user_name' => '416', 'user_age' => '0'];
        // Db::table('user')->insert($data);
        // $userId = Db::table('user')->getLastInsID();
        // dump($userId);
        // $data = [
        // ['user_name' => 'tom', 'user_age' => '0'],
        // ['user_name' => 'zl', 'user_age' => '0'],
        // ['user_name' => 'boss', 'user_age' => '0']
        // ];
//insertAll 方法添加数据成功返回添加成功的条数	
        // Db::table('user')->insertAll($data);
        //助手函数添加方便的很
        // db('user')->insertAll($data);
        // 更新数据表中的数据
// Db::table('user')->where('user_id', 1)->update(['user_name' => 'thinkphp']);
// 如果要更新的数据需要使用SQL函数或者其它字段，可以使用下面的方式：

        // Db::table('user')
        // ->where('user_id', 1)
        // ->update([
        // 	'user_time'  =>date('Y-m-d H:i:s',time()),

        // 	]);
        // 更新某个字段的值：
        // Db::table('user')->where('user_id',1)->setField('user_name', '云欧');
        // 根据主键删除
        // Db::table('user')->delete(1);
        // Db::table('user')->delete([1,2,3]);

// 条件删除    
        // Db::table('user')->where('user_id',1)->delete();
        // Db::table('user')->where('user_id','<',10)->delete();
// 助手函数
// 根据主键删除
// db('user')->delete(1);
// 条件删除    
// db('user')->where('id',1)->delete();
// Db::table('user')
//     ->where('user_name','like','%thinkphp')
//     ->where('user_age',1)
//     ->find();
// 获取`think_user`表所有信息
// dump(Db::getTableInfo('user'));

        $lsDb = Db::table('user')
            ->where('user_age', 1)
            ->order('user_time')
            ->limit(10)
            ->select();
        dump($lsDb);
//数组中的表达式查询
        $map['user_id'] = ['>', 1];
        $map['user_name'] = ['like', '%rong%'];
        $arr = db('user')->where($map)->select();
        echo $query->getLastSql();

        // dump($arr);
        //
        $joinDb = Db::table('user')->alias('a')->join(' new b ', 'a.user_new_id= b.new_id')->select();
        // dump($joinDb);
        echo $query->getLastSql();
        // Db::table('think_user')->select();
        $lbDb = Db::table('user')->field('*')->select();
        $fieldDb = Db::table('user')->field(['user_id', 'user_name'], true)->buildSql();
        // dump($fieldDb);
        // echo $query->getLastSql();
        // 对于大数据表，尽量使用limit限制查询结果，否则会导致很大的内存开销和性能问题
        // dump($lbDb);
        $lpDb = Db::table('user')->limit(1)->page(1)->select();
        // dump($lpDb);
        $distinctDb = Db::table('user')->distinct(true)->field('user_name')->comment('无重复distinct')->select();
        echo $query->getLastSql();
        dump($distinctDb);
        Db::table('user')->cache('user_name', 60)->field('user_name')->find();
        $cacheData = \think\Cache::get('user_name');
        dump($cacheData);
        Db::table('user')->where(['user_id' => 1])->update(['user_name' => 'thinkphp']);
        //如果查询不到直接抛出异常
        //   $failDb=Db::table('user')
        // ->where(['user_name' => 'liyufengs'])
        //    ->failException(false)
        //    ->select();
        $failDb = Db::table('user')
            ->where(['user_name' => 'liyufengs'])
            ->selectOrFail();
        // dump($failDb);
        //聚合查询
        $count = db('user')->count();
        dump($count);
        //快捷查询
        $ksDb = Db::table('user')
            ->where('user_name|user_time', 'like', 'thinkphp%')
            ->where('user_name&user_time', '>', 0)
            ->find();
        $subQuery = Db::table('user')
            ->field('user_id,user_name')
            ->where('user_id', '>', 10)
            ->buildSql();
        Db::table($subQuery . ' a')
            ->where('a.user_name', 'like', 'thinkphp')
            ->order('user_id', 'desc')
            ->select();
        echo $query->getLastSql();
        // 生成的SQL语句( SELECT `id`,`name` FROM `think_user` WHERE `id` > 10 )
// 生成的SQL语句为：
// SELECT * FROM ( SELECT `id`,`name` FROM `think_user` WHERE `id` > 10 ) a WHERE a.name LIKE 'thinkphp' ORDER BY `id

// Db::listen(function($ksDb, $time, $explain){
//     // 记录SQL
//     echo $ksDb. ' ['.$time.'s]';
//     // 查看性能分析结果
//     dump($explain);
// });


    }

    public function url()
    {

        return Url::build('index/index/index', 'id=5&name=thinkphp');
    }

    //实例化创建表的
    public function buyerUsers()
    {
        //1实例化创建模型对象
        $buyerUsers = new BuyerUsers();
        $result = $buyerUsers->where('id', '2409')->select();
        dump($result[0]->GetData());
        //静态方法获取
        $result = BuyerUsers::get(2409)->getUser();
        dump($result);

    }

}
