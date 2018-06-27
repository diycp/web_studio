<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
class Uploads extends Controller
{
      /**
     * 缩略图上传
     * @Author   Jenick
     * @DateTime 2018-06-26T23:36:03+0800
     */
    public function upload(Request $request)
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
}