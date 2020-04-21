<?php
namespace app\index\model;
use think\Model;
// use app\index\model\New;
use think\Request;
use think\Url;
class User extends Model
{
	// 设置当前模型对应的完整数据表名称
	protected $table = 'user';
	// 关闭自动写入时间戳
	// protected $autoWriteTimestamp = false;
 // 定义时间戳字段名
	protected $createTime = 'user_time';
	// protected $updateTime = 'user_update_time';
	protected $updateTime = false;
	protected $readonly = ['user_name'];
	protected $type = [
	'user_id'    =>  'integer',
	'user_name'     =>  'varchar',
	'user_json'  =>  'text',
	'user_age'      =>  'tinyint',
	];
	protected $auto = [];
	protected $insert = ['user_age'=>0,'user_json' => 'json'];  
	protected $update = ['user_ip']; 
      // 设置当前模型的数据库连接
	protected $connection = [
        // 数据库类型
	'type'        => 'mysql',
        // 服务器地址
	'hostname'    => '127.0.0.1',
        // 数据库名
	'database'    => 'test',
        // 数据库用户名
	'username'    => 'root',
        // 数据库密码
	'password'    => 'root',
        // 数据库编码默认采用utf8
	'charset'     => 'utf8',
        // 数据库表前缀
	'prefix'      => '',
        // 数据库调试模式
	'debug'       => true,
	];
// 修改器的作用是可以在数据赋值的时候自动进行转换处理
	public function setUserNameAttr($value)
	{
		return strtolower($value);
	}
	protected function setUserIpAttr()
	{
		return  request()->ip();
	}

	protected function getUserAgeAttr($value,$data)
    {

        $status = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
        return $status[$data['user_age']].'--'.$data['user_name'];
    }
	 //自定义初始化
	protected function initialize()
	{
        //需要调用`Model`的`initialize`方法
		// parent::initialize();
		// return 'initialize';
        //TODO:自定义的初始化
	}

	 //自定义初始化 同样也可以使用静态init方法，需要注意的是init只在第一次实例化的时候执行，并且方法内需要注意静态调用的规范，具体如下：
	protected static function init()
	{
		// echo  'init 初始化';
	}
  // 查询条件为 name = 'thinkphp' ,且只查询 id 和 name两个字段
	protected function scopeThinkphp($query)
	{
		$data['user_name']='thinkphp';
		$data['user_id']=array('gt',50);
		$query->where($data)->field('user_id,user_name,user_json');
	}
	// where(['user_name'=>'thinkphp','user_id'=>'<50'])
	 // 查询条件为 score > 80
	protected function scopeUserId($query)
	{
		$query->where('user_id','>',50);
	} 
	  // 定义全局的查询范围
	protected static function base($query)
	{
		// $query->where('user_age',0);

	}
	
	public function saves(){

		// $user = new User();
		// $user->user_name = 'THINKPHP';
		// $user->save();
		// echo $user->user_name;
		//实例化模型
		// $user = model('User');
		// $user->user_name= 'thinkphdassap';
		// $user->user_json= 'thissnkphp';
		// $user->save();
		// 静态调用
		// $user = User::get(1);
		// return $user->user_name;
		// 或者使用助手函数`model`
		// $user = model('User');
		// $user->user_name= 'modeluser';
		// $user->user_json= "{'model':'User'}";
		// $user->save();
		
		// 第二次开始必须使用下面的方式新增
		// $user->isUpdate(false)->save();
		// 也可以使用data方法批量赋值：

		// $user = new User;
		// $user->data([
		// 	'user_name'  =>  'PL',
		// 	'user_json' =>  '{"key":"PL"}'
		// 	]);
		// $user->save();

		// $user = User::find('82');
		// $user->user_name = 'THINKPHP';
		// $user->save();
		// echo $user->user_ip;
		// //或者使用
		// $user->data($data, true);
		// $user->save();
		// $query = new \think\db\Query();
		// echo $query->getLastSql();
  //       echo $user->user_time; // thinkph
		// $user = new User;
		// $list = [
		// ['user_id'=>81, 'user_name'=>'thinkphp', 'user_json'=>'thinkphp@qq.com'],
		// ['user_id'=>80, 'user_name'=>'onethink', 'user_json'=>'onethink@qq.com']
		// ];
		// $user->isUpdate()->saveAll($list);
		// 或者直接在实例化的时候传入数据

		// $user = new User([
		// 	'user_name'  =>  'PL',
		// 	'user_json' =>  '{"key":"basePL"}',
		// 	]);
		// $user->save();
		// $_POSTs=[
		// 'user_name'  =>  'PL',
		// 'user_json' =>  '{"keypl_update":"basePL"}',
		// 'user_jsonss' =>  '{"keypl":"basePL"}',

		// ];
		// $user = new User($_POSTs);
// 过滤post数组中的非数据表字段数据
		// $user->allowField(true)->save();
		//获取自增ID
		// echo $user->user_id;

		// $user = new User($_POSTs);
// post数组中只有name和email字段会写入
		// $user->allowField(['user_name','email'])->save();
		// 支持批量新增，可以使用：saveAll方法新增数据默认会自动识别数据是需要新增还是更新操作，当数据中存在主键的时候会认为是更新操作，如果你需要带主键数据批量新增，可以使用下面的方式
		// $user = new User;
		// $list=[
		// ['user_name'  =>  'PL',
		// 'user_json' =>  '{"keypl_update":"basePL"}',
		// ],
		// ['user_name'  =>  'PL2',
		// 'user_json' =>  '{"keypl_update":"basePL2"}',
		// ],

		// ];
		// $user->saveAll($list);
		// 还可以直接静态调用create方法创建并写入：
		// $user = User::create([
		// 	'user_name'  =>  'thinkphp',
		// 	'user_json' =>  'thinkphp@qq.com'
		// 	]);
		// echo $user->user_name;
		// echo $user->user_json;
  //       echo $user->user_id; // 获取自增ID
		// 也可以直接带更新条件来更新数据

		// $user = new User;
// save方法第二个参数为更新条件
		// $user->save([
		// 	'user_name'  => 'thinkphp1',
		// 	'user_json' => 'thinkphp@qq.com1'
		// 	],['user_id' => 1]);
		// $user = User::get(1);
		// $user->delete();
		//批量删除
		// User::destroy([1,2,3]);
		// 根据user_name字段查询用户
		// $userGetByName = User::getByUserName('thinkphp');
		// dump($userGetByName);
		// get方法和all方法的第三个参数表示是否使用查询缓存，或者设置缓存标识。

		// $user = User::get(1,'',true);
		// $list  = User::all('1,2,3','',true);

		// $userGet = User::get(2);
      // 获取全部获取器数据
		// dump($userGet->toArray());
		// dump($userGet->getData());

	}
	//关联模型new
	public function new(){
		return $this->hasOne("New",'new_user_id','user_id');
	}
	public function run(){
	    return 'this is /app/think/model/user@run';


    }


}