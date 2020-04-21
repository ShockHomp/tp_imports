<?php
namespace app\index\controller\one;
use think\Controller;
class Blog extends Controller 
{

    public function index()
    {
            // $event = controller('Blog', 'event');
            // echo $event->update(5); // 输出 update:5
            return $this->fetch();
            // $event = controller('admin/Blog', 'event');
            // echo $event->update(6); // 输出 update:5
            // echo $event->delete(5); // 输出 delete:5
}

public function add()
{
    return $this->fetch();
}

public function edit($id)
{
    return $this->fetch();
}



}
