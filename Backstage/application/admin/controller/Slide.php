<?php
namespace app\admin\controller;
use think\Controller;
class Slide extends Base
{
    public function index()
    {
        return $this->fetch();
    }
    
}