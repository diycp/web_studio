<?php
namespace app\index\controller;

use think\Controller;
use think\Response\Json;
use think\Db;

/**
* 前台首页
*/
class Index extends Base
{	
	public function _initialize() {
		parent::_initialize();
	}

	
    public function index()
    {
    	$map['is_recommend']       = 1;

		$posts 					   = Db::name('content')->where($map)->order('rand()')->limit(8)->select();

		$this->assign('posts', $posts);

    	return $this->fetch();
    }
}
