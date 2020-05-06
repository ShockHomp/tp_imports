<?php

namespace app\Index\controller;

use think\Controller;
use think\Request;

class Oop extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    const CALL='呼叫';
    public $_name='95';
    private static $_count=400;
    public function __set($key,$value){
        $this->$key=$value;
    }

    public function __get($key)
    {
        return $this->$key;
    }
    public static function index()
    {
        //调用常量
        dump(OoP::CALL);
        dump(self::$_count);


//        dump(Oop::index());//调用静态的方法
    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
