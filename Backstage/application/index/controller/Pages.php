<?php
namespace app\index\controller;

use think\Controller;
use think\Response\Json;
use think\Db;

/**
* 前台首页
*/
class Pages extends Base
{
	public function _initialize() {
		parent::_initialize();
	}

    public function news()
    {

        $request                   = request();
        $params                    = $request->param();
        $model1                    = Db::name('category');

        if($request->has('cat_id')) {
            $model2                = Db::name('content');
            $map['id']             = $params['cat_id'];
            $map1['cid']           = $params['cat_id'];
            $p                     = $request->has('p') ? $params['p'] : 1;
            $limit                 = $request->has('limit') ? $params['limit'] : 8;
            $data                  = $model1->where($map)->find();
            $posts                 = $model2->where($map1)->limit($p - 1, $limit)->select();
            $count                 = $model2->where($map)->count();
            $data['posts']         = $posts;   
         }

        $this->assign('posts', $data['posts']);
        $this->assign('cat_desc', $data['desc']);
        $this->assign('p', $p);
        $this->assign('limit', $limit);
        $this->assign('count', $count);

        $this->assign('ap', ceil($count / $limit));

    	return $this->fetch();
    }

    public function detail() {
    	return $this->fetch();
    }

    public function work() {
        $model1                   = Db::name('content');
        $map['is_recommend']      = 1;
        $recommend                = $model1->where($map)->find();
        $map['is_recommend']      = 0;
        $posts                    = $model1->where($map)->select();
        $model1->where($map)->select();


        $this->assign('recommend', $recommend);
        $this->assign('posts', $posts);
        return $this->fetch();
    }
}
