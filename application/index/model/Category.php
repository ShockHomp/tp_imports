<?php

namespace app\Index\model;

use think\Collection;
use think\Model;

class Category extends Model
{
    //两种方法 1递归 2全路径方式
    /**
     * @param int $pid 父ID
     * @param array $result 引用返回 （效率最高）  （引用三种方式 $_GLOBALS,static,$var）
     * @param int $blank 设置分类之间显示层级
     */
    public static function getCate($pid = 0, &$result = [], $blank = 0)
    {
        //1.分类表查询：$pid
//        (查询两种写法 一个是静态调用，一个是实例化)
        $cate = new Category();
        $res = $cate->where('pid', $pid)->select();
//        $res=$cate->all(['pid'=>$pid]);

        //2自定义分类名称前面提示信息
        $blank += 2;
        //3遍历分类表
        foreach ($res as $key => $value) {
            //3.1自定义分类名称的显示格式
            $cate_name = '|--' . $value->cate_name;
            $value->cate_name = str_repeat('$nbsp', $blank) . $cate_name;
            //3.2查询到的当前记录保持到结果集
            $result[] = $value;
            //3.3 将当前记录的ID 作为下一级的父id,$pid 继续递归调用本方法
            self::getCate($value->id, $result, $blank);

        }
        //4.返回查询结果 调用结果集类make方法 打包当前结果,转化为二维数组返回
        return Collection::make($result)->toArray();

    }
}
