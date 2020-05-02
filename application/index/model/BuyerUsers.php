<?php
//通过命令行执行创建 列在index/model中创建 BuyerUsers.php（php think make:model index/BuyerUsers）
namespace app\index\model;
use think\Model;
class BuyerUsers extends Model{


    // 关闭自动写入update_time字段
    protected $updateTime = false;
    // 设置当前模型对应的完整数据表名称
//    protected $table = '';


    public function getUser(){
        return $this->getData('openid');
    }
    //读取器( 当在控制器调用相应字段时，自动找到该对应的读取器，$data 为控制中查询的一个数组 )  //也可以自定义 字段
    protected function getOpenidAttr($openid,$data){
        return $openid;//需要的话还可以返回data中的数据如data['shop_id']
    }
    //修改器 （除了赋值的方式可以触发修改器外，还可以用下面的方法批量触发修改器：）
    public function setOpenidAttr($openid){
        return $openid='xsm';
    }





}
