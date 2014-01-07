<?php
class XmlAction extends AdminAction{
	// 资源列表
    public function show(){
		$this->assign('jumpurl',F('_xml/xucai'));
		$this->display('./Public/system/xml_show_list.html');
    }	
	// FeiFei备用库
    public function feifei(){
		$cai = D('Cai');
		$xml = $cai->xml_httpurl('feifei');
		if ($xml) {
			$this->xmlmdb($xml);		
		}else{
			$this->error("采集失败请多试几次，如一直失败通常为网络不稳定或禁用了采集！");
		}
    }
	// 资源站A型
    public function caijia(){

		$cai = D('Cai');
		$xml = $cai->xml_httpurl('caijia');
		
		if ($xml) {
			$this->xmlmdb($xml);
		}else{
			$this->error("采集失败请多试几次，如一直失败通常为网络不稳定或禁用了采集！");
		}
    }	
	// 断点续采
    public function xuncai(){
		$jumpurl = F('_xml/xucai');
		redirect($jumpurl);
    }			
	// 分解数据
	public function xmlmdb($xml){
		
		
		$cai = D('Cai');	
		$array_url = $xml['url'];
		$array_tpl = $xml['tpl'];
		$xml_page = $xml['page'];
		$list_class = $xml['listclass'];
		
		$list_vod = $xml['listvod'];	
		//是否采集入库
		if($array_url['action']){
			$page = $array_url['page'];
			echo '<style type="text/css">div{font-size:12px;color: #333333}span{font-weight:bold;color:#FF0000}</style>';
			echo'<div id="show"><div>当前采集任务<strong class="green">'.$page.'</strong>/<span class="green">'.$xml_page['pagecount'].'</span>页，共需要采集数据<span>'.$xml_page['recordcount'].'</span>个</div>';
			
			//print_r($list_vod);
				//	exit('c');

			//echo 'a'
			foreach($list_vod as $key=>$vod){
				//判断地址入库
				$vod['vod_inputer'] = 'xml_'.$array_url['fid'];
				$vod_play = explode('$$$',$vod['vod_play']);
				$vod_url = explode('$$$',$vod['vod_url']);
				echo '<div style="line-height:22px"><span>'.(($page-1)*$xml_page['pagesize']+$key+1).'</span> ['.get_channel_name($vod['vod_cid']).'] '.$vod['vod_name'].' 需采集<span>'.count($vod_play).'</span>组播放地址 <font color=green>';
				foreach($vod_play as $ii=>$value){
					$vod['vod_play'] = $value;
					$vod['vod_url'] = trim($vod_url[$ii]);
					echo $cai->xml_insert($vod,$array_url['pic']);
				}
				echo '</font></div>';
				ob_flush();flush();
			}
			if('all' == $array_url['action'] || 'day' == $array_url['action']){
				if($page < $xml_page['pagecount']){
					$jumpurl = str_replace('{!page!}',($page+1),$array_tpl['pageurl']);
					//缓存断点续采
					F('_xml/xucai',$jumpurl);	
					//跳转到下一页			
					echo C('url_create_time').'秒后将自动采集下一页!';
					echo '<meta http-equiv="refresh" content='.C('url_create_time').';url='.$jumpurl.'>';
				}else{
					//清除断点续采
					F('_xml/xucai',NULL);
					echo '<div>所有采集任务已经完成，返回[<a href="?s=Admin/Video/Show">视频管理中心</a>]，查看[<a href="?s=Admin/Video/Show/vod_cid/0">相似未入库影片</a>]!</div>';					
				}
			}
		}else{
			$array_url['vodids'] = '';
			$this->assign($array_url);
			$this->assign($array_tpl);
			$this->assign('list_class',$list_class);
			$this->assign('list_vod',$list_vod);
			$this->display('views/admin/xml_show.html');
		}
	}
	// 检测第三方资源分类是否绑定
    public function setbind(){
		$rs = M("List");
		$list = $rs->field('list_id,list_pid,list_sid,list_name')->where('list_sid = 1')->order('list_id asc')->select();
		foreach($list as $key=>$value){
			if(!getlistson($list[$key]['list_id'])){
				unset($list[$key]);
			}
		}
		$array_bind = F('_xml/bind');
		$this->assign('vod_cid',$array_bind[$_GET['bind']]);//绑定后的系统分类
		$this->assign('vod_list',$list);
		$this->display('./Public/system/xml_setbind.html');
	}
	// 存储第三方资源分类绑定
    public function insertbind(){
		$bindcache = F('_xml/bind');
		if (!is_array($bindcache)) {
			$bindcache = array();
			$bindcache['1_1'] = 0;
		}
		$bindkey = trim($_GET['bind']);
		$bindinsert[$bindkey] = intval($_GET['cid']);
		$bindarray = array_merge($bindcache,$bindinsert);
		F('_xml/bind',$bindarray);
		exit('ok');
	}						
}
?>