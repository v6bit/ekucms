<?php 
import('AdvModel');
class VideoModel extends AdvModel {
	protected $_validate=array(
	    array('cid','number','请选择分类！',1,'',3),
		array('cid','get_channel_son','请选择当前分类下面的子类栏目！',1,'function',3),
		array('title','require','影片名称必须填写！',1,'',3),
	//	array('playurl[]','require','播放地址必须填写！',1,'',3),
	);
	protected $_auto=array(
		array('title','trim',3,'function'),
		array('playurl','trim',3,'function'),
		array('downurl','trim',3,'function'),
		array('letter','m_letter',3,'callback'),
		array('addtime','m_addtime',3,'callback'),
	);
	// 回调方法
	public function m_letter(){
		return get_letter(trim($_POST['title']));
	}	
	public function m_addtime(){
		if ($_POST['checktime']) {
			return time();
		}else{
			return strtotime($_POST['addtime']);
		}
	}		
	
	/*
	* 多播放器分类
	*
	*/
	public function videoTypeList()
	{
		$playerlist = array('baidu'=>'百度','qvod'=>'快播','sohu'=>'搜狐','tudou'=>'土豆','youku'=>'优酷','qiyi'=>'奇艺','letv'=>'乐视','ck'=>'ckplayer');
		return $playerlist;
	//	echo 'wbf';
		$play=$_POST["playurl"];
		foreach($_POST["playurl"] as $key=>$val){
			$val=trim($val);
			if(!empty($val)){
			    $vod_play[]=$play[$key];
				$vod_server[]=$server[$key];
				$vod_url[]=$val;
			};
		}
		$_POST["vodplay"]=implode('$$$$$$',$vod_play);
		$_POST["playurl"]=implode('$$$$$$',$vod_url);
	}
	
	
}
?>