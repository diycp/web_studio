<?php
namespace app\admin\controller;
use think\Controller;
class Setup extends Base
{
    public function index()
    {
        return $this->fetch();
    }
    
}