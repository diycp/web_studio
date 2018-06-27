<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 返回JSON
function getJson($status, $msg="", $data=array()){
    $result = array(
        'status'  =>  $status,
        'msg'   =>  $msg,
        'data'  =>  $data
    );
    return json($result);
}

//表格返回JSON
function getTableJson($code, $msg="", $count, $data=array()){
    $result = array(
        'code'  =>  $code,
        'msg'   =>  $msg,
        'count'	=>	$count,
        'data'  =>  $data
    );
    return json($result);
}

// 单个上传文件
function uploadOne($file)
{
    $filePath = ROOT_PATH . 'public' . DS . 'uploads';
    if(!file_exists($filePath)) {
        mkdir($filePath);
    } else {
        $info = $file->validate(['ext' => 'jpg,jpeg,png'])->move($filePath);
        if($info) {
            return $info;
        } else {
            return false;
        }
    }
}