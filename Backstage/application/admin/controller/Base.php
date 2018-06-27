<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
class Base extends Controller
{
    public function __construct(){
        parent::__construct();
        $user = Session::get('user');
        
        //校验是否有该权限
        if($user['pid'] == 1){
            $this->error('您无此功能权限',url('Index/index'));
        }

       	//校验是否登录
        if(!$user){
            $this->error('请先登录！',url('Login/login'));
            
        }
    }


}
