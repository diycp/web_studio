<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
class Content extends Base
{
	/**
	 * 文章管理
	 * @Author   Jenick
	 * @DateTime 2018-06-26T23:36:29+0800
	 */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 发布文章
     * @Author   Jenick
     * @DateTime 2018-06-26T23:36:19+0800
     */
    public function addContent(Request $request)
    {
    	$cid = $request->get('cid');
    	$user = Session::get('user');
    	if($request->isPost()){
    		$data = $request->post();
    		$data['time'] = time();
    		unset($data['file']);
    		$res = model('content')->insert($data);
    		if($res){
    			return getJson(0,'发布成功');
    		}
    		return getJson(1,'发布失败');
    	}

        return $this->fetch('',[
        	'cid'	=>	$cid,
        	'name'	=>	$user['name']
        ]);
    }

    /**
     * 编辑文章
     * @Author   Jenick
     * @DateTime 2018-06-27T00:21:18+0800
     */
    public function editContent(Request $request)
    {
    	$id = $request->get('id');
    	if($request->isPost()){
    		$data = $request->post();
    		$res = model('content')
    				->where('id','=',$id)
    				->update($data);
    		if($res){
    			return getJson(0,'更新成功');
    		}
    		return getJson(1,'更新失败');
    	}

    	$data = model('content')
    				->where('id','=',$id)
    				->find();
    	return $this->fetch('',[
    		'id'	=>	$id, 
    		'data'	=>	$data
    	]);
    }

    /**
     * 编辑器图片上传
     * @Author   Jenick
     * @DateTime 2018-06-26T23:22:20+0800
     */
    public function editorUpload(Request $request)
    {
    	if($request->isPost()){
    		$file = $request->file('file');
    		$data['code'] = 0;
    		$data['msg'] = '上传成功';
    		$info = uploadOne($file);
    		if($info){
    			$data['data']['src'] = DS . 'uploads'. DS . $info->getSaveName();
    		} else {
    			$data['code'] = 1;
    			$data['msg'] = '上传失败' . $info->getError();
    		}
    		return json($data);
    	}
    	$data['code'] = 2;
		$data['msg'] = '请post提交';
    	return json($data);
    }

    /**
     * 缩略图上传
     * @Author   Jenick
     * @DateTime 2018-06-26T23:36:03+0800
     */
    public function thumbnailUpload(Request $request)
    {
    	if($request->isPost()){
    		$file = $request->file('file');
    		$info = uploadOne($file);
    		if($info){
    			$src = DS . 'uploads'. DS . $info->getSaveName();
    			return getJson(0,'上传成功',$src);
    		}
    		return getJson(2,'上传失败'.$info->getError());
    	}
    	return getJson(1,'上传失败');
    }

    /**
     * 获取文章数据
     * @Author   Jenick
     * @DateTime 2018-06-26T21:59:41+0800
     */
    public function getContent(Request $request)
    {
    	//当前页码
        $page = $request->get('page');
        //显示数量
        $limit = $request->get('limit');
        //起始值
        $start = ($page-1) * $limit;
        //搜索条件
        $condition = $request->get('condition');
        //栏目id
    	$cid = $request->get('cid');
    	//条件
    	$where = " `cid` = $cid AND `status` = '1' ";
    	if($condition){
    		$where  .= " AND `title` LIKE '%$condition%'";
    	}
    	$data = Db::name('content')
    				->where($where)
    				->limit($start,$limit)
    				->order('id desc')
    				->select();
    	$count = Db::name('content')
    				->where($where)
    				->count();

    	return getTableJson(0,'success',$count,$data);
    }
    
    /**
     * 软删除文章
     * @Author   Jenick
     * @DateTime 2018-06-27T00:27:03+0800
     */
    public function del(Request $request)
    {
    	$id = $request->get('id');
    	$res = model('content')
    			->where('id','=',$id)
    			->update(['status'=>0]);
    	if($res){
    		return getJson(0,'删除成功');
    	}
    	return getJson(1,'删除失败');
    }

    public function batchDel(Request $request)
    {
    	$ids = $request->post('id/a');
    	$res = model('content')
    			->where('id','IN',$ids)
    			->update(['status'=>0]);
    	if($res){
    		return getJson(0,'删除成功');
    	}
    	return getJson(1,'删除失败');
    }
}