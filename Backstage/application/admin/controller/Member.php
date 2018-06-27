<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Config;
use think\Db;
class Member extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    /**
     * 成员列表
     * @Author   YGF
     * @DateTime 2018-06-27T15:24:18+0800
     */
    public function listMember(Request $request)
    {
        $page = $request->get('page');
        $limit = $request->get('limit');
        $start = ($page - 1) * $limit;
        $condition = $request->get('condition');
        if($condition){
            $where = " `name` LIKE '%$condition%'";
            $data=Db::name('member')->where($where)->limit($start,$limit)->select();
            $count=Db::name('member')->where($where)->count();
        } else {
            $data=Db::name('member')->limit($start,$limit)->select();
            $count=Db::name('member')->count();
        }
        return getTableJson(0,'success',$count,$data);     
    }

    /**
     * 查看成员
     * @Author   YGF
     * @DateTime 2018-06-27T15:23:18+0800
     */
    public function showMember(Request $request){
            $id=input('id');
            $data=Db::name('member')->where('id',$id)->find();
            $this->assign('data',$data);
        return $this->fetch();
    
    }


    /**
     * 新增成员
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function addMember(Request $request)
    {
    	if($request->isPost()){
      		$data=$request->post();
            unset($data['file']);
	          $res=Db::name('member')->insert($data);
	          if($res){
	          	return getJson(0,'新增成功');
	          }
      			return getJson(1,'新增失败');
      	}
        return $this->fetch();
    }


    /**
     * 修改成员信息
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function editMember(Request $request)
    {
        
 		$id=input('id');
 		$data=Db::name('member')->where('id',$id)->find();
 		$this->assign('data',$data);
    	if($request->isPost()){
            $data=$request->post();
            unset($data['file']);
              $res=Db::name('member')->where('id',$id)->update($data);
              if($res){
                return getJson(0,'修改成功');
              }
                return getJson(1,'修改失败');
        }
       return $this->fetch();
    }
     

    /**
     * 删除成员
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function delMember()
    {
        $id=input('id');
        $res=Db::name('member')->where('id',$id)->delete();
        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');
    }

      /**
     * 批量删除
     * @Author   YGF
     * @DateTime 2018-06-27T17:23:18+0800
     */
    public function batchDel (Request $request){
       $ids = $request->post('ids/a');
        $table = Config::get("database.prefix") . 'member';
        $res = Db::table($table)
                ->delete($ids);

        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');
    }


   /**
     * 成员作品区域
     * @Author   YGF
     * @DateTime 2018-06-27T14:25:18+0800-----------------------
     */
    
    public  function works(){

       return $this->fetch();
    }


    /**
     * 查看作品
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function showWorks(){
            $id=input('id');
            $data=Db::name('works')->where('id',$id)->find();
            $this->assign('data',$data);
        return $this->fetch();
    }



   /**
     * 作品列表
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function listWorks(Request $request){
        $page = $request->get('page');
        $limit = $request->get('limit');
        $start = ($page - 1) * $limit;
        $condition = $request->get('condition');
        if($condition){
            $where = " `mid` LIKE '%$condition%'";
            $data=Db::name('works')->where($where)->limit($start,$limit)->select();
            $count=Db::name('works')->where($where)->count();
        } else {
            $data=Db::name('works')->limit($start,$limit)->select();
            $count=Db::name('works')->count();
        }
        return getTableJson(0,'success',$count,$data); 
    
    }

    /**
     * 添加作品
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function addWorks(Request $request){

        $Snumber=input('id');
        $this->assign('Snumber',$Snumber);
        if($request->isPost()){
                    $data=$request->post();
                    unset($data['file']);
                      $res=Db::name('works')->insert($data);
                      if($res){
                        return getJson(0,'新增成功');
                      }
                        return getJson(1,'新增失败');
                }
                return $this->fetch();
    }


    /**
     * 修改作品
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function editWorks(Request $request){

        $id=input('id');
        $data=Db::name('works')->where('id',$id)->find();
        $this->assign('data',$data);
        if($request->isPost()){
                    $data=$request->post();
                    unset($data['file']);
                      $res=Db::name('works')->where('id',$id)->update($data);
                      if($res){
                        return getJson(0,'修改成功');
                      }
                        return getJson(1,'修改失败');
                }
                return $this->fetch();
    }
    /**
     * 删除作品
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function delWorks(){
         $id=input('id');
        $res=Db::name('works')->where('id',$id)->delete();
        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');

    }

      /**
     * 批量删除
     * @Author   YGF
     * @DateTime 2018-06-27T17:23:18+0800
     */
    public function batchDelWorks (Request $request){
       $ids = $request->post('ids/a');
        $table = Config::get("database.prefix") . 'works';
        $res = Db::table($table)
                ->delete($ids);

        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');
    }



}