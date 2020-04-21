<?php
namespace app\index\widget;
use think\Controller;
class Blog extends Controller
{
    public function index(){
        $list=array(
            array('id'=>'1','bookname'=>'book_1'),
            array('id'=>'2','bookname'=>'book_2'),

            );
        // dump($list);die;
        $this->assign('list',$list);
        return $this->fetch('widget/blog/index');

    }



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
