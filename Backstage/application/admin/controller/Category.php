<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Config;
use think\Db;
class Category extends Controller
{

    public function index()
    {
        return $this->fetch();
    }

    /**
     * 栏目列表
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function listCategory(Request $request){
        $page = $request->get('page');
        $limit = $request->get('limit');
        $start = ($page - 1) * $limit;
        $condition = $request->get('condition');
        if($condition){
            $where = " `Lname` LIKE '%$condition%'";
            $data=Db::name('Category')->where($where)->limit($start,$limit)->select();
            $count=Db::name('Category')->where($where)->count();
        } else {
            $data=Db::name('Category')->limit($start,$limit)->select();
            $count=Db::name('Category')->count();
        }
        return getTableJson(0,'success',$count,$data);
    }



   /**
     * 新增栏目
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function addCategory(Request $request)
    {
          //获取栏目值
          $data = Db::name('Category')->where("pid = 0")->order('pid ASC')->select();
          $this->assign('data',$data);
  
          if($request->isPost()){
                $data=$request->post();
                unset($data['file']);
                $res= Db::name('category')->insert($data);
                if($res){
                    return getJson(0,'新增成功');
                }
                return getJson(1,'新增失败');
          }
              return $this->fetch();
    }

      /**
     * 修改栏目
     * @Author   YGF
     * @DateTime 2018-06-27T15:22:18+0800
     */
    public function editCategory(Request $request){
        
          $id=input('id');
          $data=Db::name('category')->where('id',$id)->find();
          $Pid=Db::name('category')->where('id',$data['pid'])->find();
          $dataId=Db::name('category')->where('pid','0')->select();
          $this->assign(array('data'=>$data,'dataId'=>$dataId,'Pid'=>$Pid));

          if($request->isPost()){
                $data=$request->post();
                unset($data['file']);
                $res= Db::name('category')->where("id",$id)->update($data);
                if($res){
                    return getJson(0,'修改成功');
                }
                    return getJson(1,'修改失败');
          }
           return $this->fetch();
    }


    /**
     * 删除栏目
     * @Author   YGF
     * @DateTime 2018-06-27T15:21:18+0800
     */
    public function delcategory(){
        $id=input('id');
        $res=Db::name('category')->where('id',$id)->delete();
        $res=Db::name('category')->where('pid',$id)->delete();
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
        $table = Config::get("database.prefix") . 'category';
        $res = Db::table($table)
                ->delete($ids);

        if($res){
            return getJson(0,'删除成功');
        }
        return getJson(1,'删除失败');
    }


    public function getCategory()
    {
    	$field = [
    		'id',
    		'Lname as name',
    		'pid'
    	];

    	$data = Db::name('category')
    				->field($field)
    				->select();
    	$data = model('category')->tree($data);
    	return getJson(0,'success',$data);
    }
}