<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Config;

/**
 * 管理员控制器
 */
class Admin extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 新增管理员
     * @Author   Jenick
     * @DateTime 2018-06-25T21:03:54+0800
     */
    public function addAdmin(Request $request)
    {
    	if($request->isPost()){
    		$data = $request->post();
    		$data = array_merge($data,[
    			'password'	=>	md5($data['password']),
                'pid' 		=> 	1,
    			'time'		=>	time()
            ]);
            $res =  model('admin')
                    ->where('username','=',$data['username'])
                    ->select();
            if($res){
                return getJson(1,'用户名已存在');
            }

    		$res =  model('admin')->insert($data);
    		if($res){
    			return getJson(0,'新增成功');
    		}
    		return getJson(2,'新增失败');
    	}

        return $this->fetch();
    }

    /**
     * 获取管理员数据
     * @Author   Jenick
     * @DateTime 2018-06-25T21:34:13+0800
     */
    public function getData(Request $request)
    {   
        //当前页码
        $page = $request->get('page');
        //显示数量
        $limit = $request->get('limit');
        //起始值
        $start = ($page-1) * $limit;
        //搜索条件
        $condition = $request->get('condition');
        //条件
        $where = "`pid` = 1 ";
        if($condition){
           $where .= " AND `name` LIKE '%$condition%' OR `username` LIKE '%$condition%'";
        }

    	$data = Db::name('admin')
                    ->where($where)
                    ->order('id desc')
                    ->limit($start,$limit)
                    ->select();

    	$count = model('admin')
                    ->where('pid','=',1)
                    ->count();
		return getTableJson(0,'success',$count,$data);
    }

    /**
     * 禁用或者启用管理员账号
     * @Author   Jenick
     * @DateTime 2018-06-25T22:37:18+0800
     */
    public function editSwitch(Request $request)
    {
        $switch = $request->get('switch');
        $id = $request->get('id');

        $res = model('admin')
                ->where('id','=',$id)
                ->update(['switch'=>$switch]);

        if($res){
            return getJson(0,'更新成功');
        }
        return getJson(1,'更新失败');
    }
    
    /**
     * 重置密码
     * @Author   Jenick
     * @DateTime 2018-06-25T22:48:21+0800
     */
    public function resetPass(Request $request)
    {
        $id = $request->get('id');
        $username = $request->get('username');
        $password = md5($username);

        $res = model('admin')
                ->where('id','=',$id)
                ->update(['password'=>$password]);

        if($res){
            return getJson(0,'重置成功');
        }
        return getJson(1,'重置失败');
    }

    /**
     * 删除管理员账号
     * @Author   Jenick
     * @DateTime 2018-06-26T00:14:28+0800
     */
    public function delAdmin(Request $request)
    {
        $id = $request->get('id');
        $res = model('admin')
                ->where('id','=',$id)
                ->delete();
        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');
    }

    /**
     * 编辑管理员账号
     * @Author   Jenick
     * @DateTime 2018-06-26T00:25:55+0800
     */
    public function editAdmin(Request $request)
    {
        $id = $request->get('id');

        if($request->isPost()){
            $name = $request->post('name');
            $res = model('admin')
                    ->where('id','=',$id)
                    ->update(['name'=>$name]);
            if($res){
                return getJson(0,'更新成功');
            }   
            return getJson(1,'更新失败');
        }

        $data = model('admin')
                ->where('id','=',$id)
                ->find();

        return $this->fetch('',[
            'data'  =>  $data
        ]);
    }

    /**
     * 批量删除管理员账号
     * @Author   Jenick
     * @DateTime 2018-06-26T01:57:14+0800
     */
    public function batchDel(Request $request)
    {
        $ids = $request->post('ids/a');
        $table = Config::get("database.prefix") . 'admin';
        $res = Db::table($table)
                ->delete($ids);

        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');
    }
}