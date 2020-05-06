<?php
namespace app;
class Test{
    const CALL='95呼叫';
	public function test(){
        dump(Test::CALL) ;
		return 'app下面的类文件直接定义路由来访问';
	}
	public function  testdata(){
		return 'hhhh';
	}

}
