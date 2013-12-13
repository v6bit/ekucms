<?php 
import('AdvModel');
class SelfModel extends AdvModel {
	
							
	public function getType($id=NULL)
	{
		$m 			=	M('self_type');
		$dataArr	=	$m->select();
		if ($id)
		{
			foreach($dataArr as $v)
			{
				if ($v['id'] == $id) return $v['name'];
			} 
			//return $this->_type[$id];
		}
		else
		{
			//	var_dump($m->select());
			return $dataArr;
		}
		
	}

	
	
}
?>