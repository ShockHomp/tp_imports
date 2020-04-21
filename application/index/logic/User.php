<?php
namespace app\index\logic;
header('Content-Type:text/html; charset=utf-8');
use think\Model;
use think\Request;
class User extends Model
{

	public function index(){
		echo 'model/logic/index';
	}

}