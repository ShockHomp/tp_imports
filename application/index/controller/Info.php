<?php
namespace app\index\controller;
use think\Controller\Rest;
class Info extends Rest
{
    // http://serverName/index/info/read/id/1.xml
    public function read_get_xml($id)
    {
        // 输出id为1的Info的XML数据
        return 'resd_get_xml 方法';
    }
    
    public function read_xml($id)
    {
        // 输出id为1的Info的XML数据
    }
    
    public function read_json($id)
    {
        // 输出id为1的Info的json数据
    }
}
