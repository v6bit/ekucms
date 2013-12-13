<?php
/**
 * Cat 模型类
 * by 米修 QQ531209114 
 */
class StypeModel extends Model
{
	//自动验证
	protected $_validate=array(
		array('m_order','number','排序ID必须为数字',1),
		array('m_name','require','分类名称错误',1),
	);
	
	public function list_cat($list_id)
	{
		$pp_list = M('channel')->where("id = {$list_id}")->field("pid")->find();
		if($pp_list && $pp_list['pid'] > 0){
			$list_id = $pp_list['pid'];
		}
		return $this->where("m_list_id = {$list_id}")->order("m_order desc")->findAll();
	}
}
/* End of File McatModel.class.php */
/* Create by Chris.mixiu@gmail.com */
