<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\db\Query;
use think\Request;
// 应用公共文件
//function getHiredate($id){
//	$query = new \think\db\Query();
//	$result = $query->table('user')->find($id);
//	$result= \think\Db::table('user')->find($id);
//	return $result['user_ip'];
//}
$request=Request::instance();
//请求对象属性注入
$request->siteName="PHP中文网";
//请求对象方法注入
function  getSiteName(Request $request){
    return '站点名称:'.$request->siteName;
}
//注册请求对象的方法，也叫钩子
Request::hook('names','getSiteName');

function my_check_fun(){
    return true;
}