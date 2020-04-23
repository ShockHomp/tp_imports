<?php
//通过命令行执行创建 列在index/model中创建 BuyerUsers.php（php think make:model index/BuyerUsers）
namespace app\index\model;
use think\Model;
class BuyerUsers extends Model{
    public function getUser(){
        return $this->getData('openid');
    }
}