<?php
namespace app\common\model;
use think\Model;
class Category extends Model
{
	/**
	 * 递归分类
	 * @Author   Jenick
	 * @DateTime 2018-06-26T21:26:23+0800
	 * @param    array $data 栏目
	 * @param    int $pid 父id
	 * @return   array
	 */
	public function tree($data, $pid = 0)
	{
		$array = '';
		foreach($data as $k => $v)
		{
		  if($v['pid'] == $pid){
		   $v['children'] = $this->tree($data, $v['id']);
		   $array[] = $v;
		   unset($data[$k]);
		  }
		}
		return $array;
	}
}