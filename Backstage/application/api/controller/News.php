<?php
namespace app\api\controller;

use think\Controller;
use think\Response\Json;

/**
* 前台首页
*/
class News extends Base
{
    public function index()
    {
    	return $this->fetch();
    }
}
