<?php

namespace app\Index\model;

use think\Model;

class Goods extends Model
{
    public function Cart()
    {
        return $this->hasMany('Cart','goods_id','id');

    }
}
