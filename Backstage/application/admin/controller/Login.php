<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use think\Request;
use think\Session;
class Login extends controller
{
	/**
	 * 登录
	 * @Author   Jenick
	 * @DateTime 2018-06-26T16:27:03+0800
	 */
    public function login(Request $request)
    {
    	if($request->isPost()){
    		$data = $request->post();
    		$captcha = new Captcha;
			if(!$captcha->check($data['code'],1)){
				return getJson(1,'验证码错误!');
            }
            $user = model('admin')
            			->where('username','=',$data['username'])
            			->find();
           	if($user){
           		if($user['password'] == md5($data['password'])){
           			Session::set('user',$user);
           			return getJson(0,'登录成功');
           		}
           		return getJson(3,'密码不正确!');
           	}
           	return getJson(2,'用户不存在!');
    	}
        return $this->fetch();
    }
    	
    /**
     * 生成验证码
     * @Author   Jenick
     * @DateTime 2018-06-26T16:25:49+0800
     */
    public function captche(){
        $config = [
        	'codeSet'	=>'0123456789',
            'fontSize'  =>  100,
            'expire'	=>	1800,
            'length'    =>  4,
            'useNoise'  =>  false,
            'reset'		=>	true

        ];
        $captcha = new Captcha($config);  
        return $captcha->entry(1);
    }

    public function loginOut()
    {
        session(null);
        return getJson(0,'退出成功');
    }
}