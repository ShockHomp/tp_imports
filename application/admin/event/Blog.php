<?php
namespace app\admin\event;
use think\Controller;
class Blog 
{
    
        public function insert()
    {
        return 'insert';
    }
    
    public function update($id)
    {
        return 'update:'.$id;
    }
    
    public function delete($id)
    {
        return 'delete:'.$id;
    }
    
// $event = \think\Loader::controller('Blog', 'event');
// echo $event->update(5); // 输出 update:5
    
}
