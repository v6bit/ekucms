<?php 
import('AdvModel');
class WeiModel extends AdvModel {
	//stripslashes、htmlentities、htmlspecialchars
	
	protected $_validate=array(
		array('name','require','名称必须填写！',1,'',3),
	);
	
	public function lists()
	{
		$list = M('linkkeys')->field("id,name,link,count,target")->findAll();
		return $list;
	}
	
	public function replacelists()
	{
		$list = M('replacekeys')->field("id,firstkey,endkey")->findAll();
		return $list;
	}
	
	
}
?>