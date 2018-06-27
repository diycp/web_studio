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
/**
 * 获取性别
 * @Author   Jenick
 * @DateTime 2017-12-11T20:47:33+0800
 * @param    int $sex 性别 0-女 1-男 其他-保密
 * @return   String 性别
 */
function getSex($sex){
    if($sex== 0){
        return '女';
    } elseif($sex == 1){
        return '男';
    } elseif($sex == 2) {
        return '保密';
    } else {
    	return '保密';
    }
}