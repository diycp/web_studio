<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Config;
use think\Session;
class Notice extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    

     /**
     * 公告列表
     * @Author   YGF
     * @DateTime 2018-06-27T15:24:18+0800
     */
     public function listNotice(Request $request)
    {

    	$page = $request->get('page');
        $limit = $request->get('limit');
        $start = ($page - 1) * $limit;
        $condition = $request->get('condition');
        if($condition){
            $where = " `title` LIKE '%$condition%'";
            $data=Db::name('notice')->where($where)->limit($start,$limit)->select();
            $count=Db::name('notice')->where($where)->count();
        } else {
            $data=Db::name('notice')->limit($start,$limit)->select();
            $count=Db::name('notice')->count();
        }
        return getTableJson(0,'success',$count,$data);
        return $this->fetch();
    }


     /**
     * 发布公告
     * @Author   YGF
     * @DateTime 2018-06-27T15:24:18+0800
     */
     public function addNotice(Request $request)
    {
    
    	if($request->isPost()){
                $data=$request->post();
                $res= Db::name('notice')->insert($data);
                if($res){
                    return getJson(0,'新增成功');
                }
                return getJson(1,'新增失败');
          }

        return $this->fetch();
    }

     /**
     * 修改公告
     * @Author   YGF
     * @DateTime 2018-06-27T15:24:18+0800
     */
     public function editNotice(Request $request)
    {
    	$id=input('get.id');
    	$data=Db::name('notice')->where('id',$id)->find();
    	if($request->isPost()){
                $data=$request->post();
                // dump($id);return;
                $res= model('notice')
						    ->where('id', $id)
						    ->update([
						        'title'  => $data['title'],
						        'content' => $data['content'],
						    ]);
                if($res){
                    return getJson(0,'修改成功');
                }
                return getJson(1,'修改失败');
          }
        return $this->fetch('',[
        	'data'	=>	$data,
    	]);
    }


     /**
     * 删除公告
     * @Author   YGF
     * @DateTime 2018-06-27T15:24:18+0800
     */
     public function delNotice(Request $request)
    {  
    	$id=input('id');
        $res=Db::name('notice')->where('id',$id)->delete();
        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');
    }

     /**
     * 批量删除
     * @Author   YGF
     * @DateTime 2018-06-27T15:24:18+0800
     */
     public function batchdel(Request $request)
    {  
    	$ids = $request->post('ids/a');
        $table = Config::get("database.prefix") . 'notice';
        $res = Db::table($table)
                ->delete($ids);

        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');
    }

}