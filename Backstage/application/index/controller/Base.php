<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Base extends Controller
{
	const NEWSCID = '100';//通知公告
	const UPNEWSCID = '101';
	const RESULTSCID = '102';
	protected $isLogin = true;
	public function __construct(){
		parent::__construct();
	}
	/**
	* 转换为JSON数据
	* @param int $code 状态码
	* @param String $msg 信息
	* @param array $data 数据
	* @return JSON
	*/

	public function _initialize() {
		$request  				   = request();
		$params 				   = $request->param();
		$model1 				   = Db::name('category');
		$map['pid'] 			   = 0;

		$cat_id 				   = $request->has('cat_id') ? $params['cat_id'] : '';
		$breack 				   = array();

		if($cat_id) {
			$d 					   = $model1->where('id='.$cat_id)->find();
			$breack[] 		   	   = $d;
			if($d['pid'] != 0) {
				$d 	 		 		   = $model1->where('id='.$pid_cat['pid'])->find();
				array_unshift($breack, $d);
			}
		}

		
		

		$model1 				   = DB::name('category');
		$map['type'] 			   = 'top';
		$header_menu 			   = $model1->where($map)->select();
		$map['type'] 			   = 'bottom';
		$footer_menu 			   = $model1->where($map)->select();

		$this->assign('header', $header_menu);
		$this->assign('footer', $footer_menu);
		$this->assign('breack', $breack);
	}

	public static function getJson($status, $msg="", $data=array()){
		$result = array(
			'status'	=>	$status,
			'msg'		=>	$msg,
			'data'		=>	$data
		);
		return json($result);
	}
	/**
	* 获取浏览者ip地址
	* @return String
	*/
	public function getClientIp(){
	    if(isset($_SERVER["HTTP_CLIENT_IP"]) and strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")){
	        return $_SERVER["HTTP_CLIENT_IP"];
	    }
	    if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]) and strcasecmp($_SERVER[""], "unknown")){
	        return $_SERVER["HTTP_X_FORWARDED_FOR"];
	    }
	    if(isset($_SERVER["REMOTE_ADDR"])){
	        return $_SERVER["REMOTE_ADDR"];
	    }
	    return "";
	}
	
}