<?php

namespace app\index\behavior;

class UserCheck
{
    public function run()
    {
        if('user/0'==request()->url()){
            return true;
        }
    }
}