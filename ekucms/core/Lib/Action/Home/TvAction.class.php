<?php
class tvAction extends HomeAction{
	public function index()
	{
		$title = '电视直播_'.C('web_name');
		$this->assign('webtitle',$title);
		$this->display('tv');
	}
}
?>