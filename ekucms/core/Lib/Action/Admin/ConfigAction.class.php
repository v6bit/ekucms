<?php
/**
 * @name 系统配置模块
 */
class ConfigAction extends AdminAction{
	
	// 基本信息设置
    public function conf(){
		$id     = trim($_GET['id']);
		$config = require './config.php';
		$tpl    = './template/*';
		$list   = glob($tpl);
		foreach($list as $i => $file){
			if (!is_file($file) && $file != "." && $file != ".." && $file!=".svn" )//add
			$temp[$i]['filename']=basename($file);
		}
		
		
		if ($id == 'user'){
			$rsc = D("Admin.Channel");
			$channel_list = $rsc->field('id,pid,mid,cname')->where('mid = 1')->order('id asc')->select();
			$channel_tree = list_to_tree($channel_list,'id','pid','son',0);
			$this->assign('channel_tree',$channel_tree);
		}
		
		$this->create_channel();
		$this->assign('temp',$temp);
		$this->assign($config);
	    $this->display('./views/admin/con_'.$id.'.html');
    }
    
	// 配置信息保存
    public function updateconfig($config){
		$config_old = require './config.php';
		if(is_array($config)) $config_new = array_merge($config_old,$config);
		arr2file('./config.php',$config_new);
		@unlink('./temp/~app.php');
		if (!$config_new['url_index']) {//动态模式则删除首页静态文件
			@unlink('./index'.C('html_file_suffix'));
		}
		$this->success('恭喜您，配置信息更新成功！');
		
	}
	
	//更新web相关配置
    public function updateweb(){
		$config = $_POST["con"];
		$config['web_admin_pagenum']  = abs(intval($config['web_admin_pagenum']));
		$config['web_admin_hits']     = abs(intval($config['web_admin_hits']));
		$config['web_hits_time']      = abs(intval($config['web_hits_time']));
		$config['web_admin_score']    = abs(intval($config['web_admin_score']));
		$config['web_admin_updown']   = abs(intval($config['web_admin_updown']));
		$config['web_url']            = getaddxie($config['web_url']);
		$config['web_path']           = getaddxie($config['web_path']);
		$config['web_adsensepath']    = getrexie($config['web_adsensepath']);
		$config['web_tongji']         = stripslashes($config['web_tongji']);
		$config['web_admin_edittime'] = (bool) $config['web_admin_edittime'];
		$config['web_collect_num']    = abs(intval($config['web_collect_num']));
		$config['player_web_url']    = $config['web_url'];
		
		
		mkdirss('./'.$config['web_adsensepath']);
		get_admin_hotkey($config['web_hotkey']);
		$this->updateconfig($config);
	}
	
	//附件配置
    public function updateup(){
		$config = $_POST["con"];
		$config['upload_thumb_w']   = abs(intval($config['upload_thumb_w']));
		$config['upload_thumb_h']   = abs(intval($config['upload_thumb_h']));
		$config['upload_water_pct'] = abs(intval($config['upload_water_pct']));
		$config['upload_water_pos'] = abs(intval($config['upload_water_pos']));
		$config['upload_http_down'] = abs(intval($config['upload_http_down']));
		$config['upload_ftp_port']  = abs(intval($config['upload_ftp_port']));
		mkdirss('./'.C('upload_path'));
		$this->updateconfig($config);
	}
	
    public function updatecache(){
		$config = $_POST["con"];
		$config['html_cache_index']  = abs(intval($config['html_cache_index']));
		$config['html_cache_list']   = abs(intval($config['html_cache_list']));
		$config['html_cache_content']= abs(intval($config['html_cache_content']));
		$config['html_cache_play']   = abs(intval($config['html_cache_play']));		
		$config['tmpl_cache_on']     = (bool) $config['tmpl_cache_on'];
		$config['html_cache_on' ]    = (bool) $config['html_cache_on'];
		$config['html_cache_time']   = $config['html_cache_time']*3600;
		if ($config['html_cache_index'] > 0) {
			$config['_htmls_']['home:index:index'] = array('{:action}',$config['html_cache_index']*3600);
		}else{
			$config['_htmls_']['home:index:index'] = NULL;
		}
		if ($config['html_cache_list'] > 0) {
		    $config['_htmls_']['home:video:lists'] = array('{:module}_{:action}/{$_SERVER.REQUEST_URI|md5}',$config['html_cache_list']*3600);
			$config['_htmls_']['home:info:lists']  = array('{:module}_{:action}/{$_SERVER.REQUEST_URI|md5}',$config['html_cache_list']*3600);
		}else{
		    $config['_htmls_']['home:video:lists'] = NULL;
			$config['_htmls_']['home:info:lists']  = NULL;
		}
		if ($config['html_cache_content'] > 0) {
		    $config['_htmls_']['home:video:detail'] = array('{:module}_{:action}/{id}/{id|md5}',$config['html_cache_content']*3600);
			$config['_htmls_']['home:info:detail']  = array('{:module}_{:action}/{$_SERVER.REQUEST_URI|md5}',$config['html_cache_content']*3600);
		}else{
		    $config['_htmls_']['home:video:detail'] = NULL;
			$config['_htmls_']['home:info:detail']  = NULL;
		}
		if ($config['html_cache_play'] > 0) {
		    $config['_htmls_']['home:video:play'] = array('{:module}_{:action}/{ids}/{id}',$config['html_cache_play']*3600);
		}else{
		    $config['_htmls_']['home:video:play'] = NULL;
		}						
		if ($config['html_cache_mytpl'] > 0) {
		    $config['_htmls_']['home:my:show'] = array('{:module}_{:action}/{$_SERVER.REQUEST_URI|md5}',$config['html_cache_mytpl']*3600);
		}else{
		    $config['_htmls_']['home:my:show'] = NULL;
		}
		$this->updateconfig($config);
	}
    public function updateurl(){
		$config = $_POST["con"];
		$config['url_create_num']  = abs(intval($config['url_create_num']));
		$config['url_create_time'] = abs(intval($config['url_create_time']));
		//更新播放器
		$url_html_play				=		$config['url_html'] == 1 ? $config['url_html_play'] : 0;
		$html_file_suffix			=		$config['html_file_suffix'];
		$this->updateplayer(true,$url_html_play,$html_file_suffix);
		$this->updateconfig($config);
	}
	
    public function Updaterewrite(){
		$config = $_POST["con"];
		//更新播放器
		if ($config['url_rewrite']) //启动伪静态的情况
		{
			$html_file_suffix			=		$config['url_html_suffix'];
			$url_html_play				=		$config['url_html'] == 1 ? $config['url_html_play'] : 0;
		}else{
			$oldconfig = require './config.php';
			$html_file_suffix			=		$oldconfig['html_file_suffix'];
			if ($oldconfig['url_html'] == 1) //静态模式
			{
				$url_html_play = $oldconfig['url_html_play'];
			}else{
				$url_html_play = 0;
			}
		}
		if ($config['url_rewrite'])
		{
			$this->updaterewritefile();
		}else{
			@unlink('./.htaccess');
		}
		
		$this->updateplayer(true,$url_html_play,$html_file_suffix);
		$this->updateconfig($config);
		
				// 生成rewrite 规则

	}
	
	
	private function updaterewritefile()
	{
		
		$old = array(
					'rewrite_videolist'=>array('url'=>'/index.php?s=video/lists/id/$id/p/$page.html'),
					'rewrite_videodetail'=>array('url'=>'/index.php?s=video/detail/id/$id.html'),
					'rewrite_videoplay'=>array('url'=>'/index.php?s=video/play/id/$id.html'),
					'rewrite_videosearch'=>array('url'=>'/index.php?s=video/search'),
					'rewrite_newslist'=>array('url'=>'/index.php?s=info/lists/id/$id.html'),
					'rewrite_newsinfo'=>array('url'=>'/index.php?s=info/detail/id/$id.html'),
					'rewrite_newssearch'=>array('url'=>'/index.php?s=info/search/$wd.html'),
					'rewrite_speciallist'=>array('url'=>'/index.php?s=special/lists/page/$page.html'),
					'rewrite_specialdetail'=>array('url'=>'/index.php?s=special/$id.html'),
					'rewrite_guestbook'=>array('url'=>'/index.php?s=guestbook/$page.html'),
					'rewrite_map'=>array('url'=>'/index.php?s=map/lists/$page.html'),
					
					
					);
		$params		=	array('$id','$wd','$page','$limit','$area','$language','$actor','$director','$year','$letter','$order','$sid');
		$paramsend	=	array();
		
		$config = $_POST["con"];
		
		foreach($config as $k=>&$v)
		{
			if ($k != 'url_html_suffix')
			{
				$config[$k] = $v.$config['url_html_suffix'];
			}
		}
		
		unset($config['url_html_suffix'],$config['url_rewrite']);
		
		//生成 NG 
		$strng = "# 易酷提醒，此为易酷后台伪静态配置自动生成的NGINX 伪静态规则\r\n";
		$strng .= "\r\n";
		$strng .= "\r\n";
		$strng .= "# Rewrite 系统规则请勿修改\r\n";
		
		//生成 httpd.ini文件
		$strhttpd = "[ISAPI_Rewrite]\r\n";
		$strhttpd .= "# Rewrite 2.x\r\n";
		$strhttpd .= "# 3600 = 1 hour\r\n";
		$strhttpd .= "CacheClockRate 3600\r\n";
		$strhttpd .= "RepeatLimit 32\r\n";
		
		
		//.hta 文件
		$str = "# 易酷提醒将 RewriteEngine 模式打开\r\n";
		$str .= "RewriteEngine On\r\n";
		$str .= "\r\n";
		$str .= "# 如果程序放在子目录中，请将 / 修改为 /子目录/\r\n";
		$str .= "RewriteBase /\r\n";
		$str .= "\r\n";
		$str .= "# Rewrite 系统规则请勿修改\r\n";
		
		foreach($old as $k=>$v)
		{
			$paramsend = array();
			foreach($params as $v3)
			{
				$find = strpos($config[$k],$v3);
				if ($find !== false)
				{
					$paramsend[$v3] = $find;
				}
			}
			asort($paramsend);
			$mm = 1;
			foreach($paramsend as $k4=>$v4)
			{
				$v['url'] = str_replace($k4,'$'.$mm,$v['url']);
				$mm++;
			}
			$v2 = str_replace(array('$id','$page','$wd'),array('(.*)','(.*)','(.*)'),$config[$k]);
			$str .= "RewriteRule ".$v2."$ ".$v['url']."\r\n";
			$strng .= "rewrite ^".$v2."$ ".$v['url']."\tlast;\r\n";
			
			$strhttpd .= "RewriteRule ^".$v2."$ ".$v['url']."\r\n";
		}
		
		write_file('./.htaccess',$str);	
		write_file('./rewrite/httpd.ini',$strhttpd);
		write_file('./rewrite/ekurewerite.conf',$strng);
	}
	
	
    public function updateuser(){
		$config = $_POST["con"];
		$config['user_money_play']   = abs(intval($config['user_money_play']));
		$config['user_money_change'] = abs(intval($config['user_money_change']));
		$config['user_money_add']    = abs(intval($config['user_money_add']));
		$config['user_check_time']   = abs(intval($config['user_check_time']));	
		$config['user_page_cm']      = abs(intval($config['user_page_cm']));
		$config['user_page_gb']      = abs(intval($config['user_page_gb']));					
		if (empty($config['user_paycid'])){
			$config['user_paycid'] = '';
		}
		$this->updateconfig($config);
	}
    public function updatedb(){
		$config = $_POST["con"];
		$config['db_port'] = abs(intval($config['db_port']));
		$this->updateconfig($config);
	}
    public function updatenav(){
		$config = $_POST["con"];
		if(empty($config["web_admin_nav"])){
			$this->error('自定义菜单不能为空！');
		}
		foreach(explode(chr(13),trim($config["web_admin_nav"])) as $value){
			list($key,$val) = explode('|',trim($value));
			if(!empty($val)){
				$arrlist[trim($key)] = trim($val);
			}
		}
		$config['web_admin_nav'] = $arrlist;
		$this->assign("jumpUrl",C('cms_admin').'?s=Admin/Config/Conf/id/nav/reload/1');
		$this->updateconfig($config);
	}
    public function updateplayer($from=false,$url_html_play=0,$html_file_suffix='.html'){
		$config_old = require './config.php';
		$config = $_POST["con"];
		if ($from == true) $config = $config_old;
		$config['player_width']  = abs(intval($config['player_width']));
		$config['player_height'] = abs(intval($config['player_height']));
		$player  ='var player_width='.$config['player_width'].';';
		$player .='var player_height='.$config['player_height'].';';
		$player .='var player_down="'.$config['player_down'].'";';
		$player .='var qvod_player_down="'.$config['qvod_player_down'].'";';
		$player .='var player_buffer="'.$config['player_buffer'].'";';
		$player .='var player_time="'.$config['player_time'].'";';
		$player .='var player_pause="'.$config['player_pause'].'";';
		$player .='var ckplayer_f_p="'.$config['ckplayer_f_p'].'";';
		$player .='var ckplayer_f_p_l="'.$config['ckplayer_f_p_l'].'";';
		$player .='var ckplayer_f_u="'.$config['player_web_url'].'";';
		$player .='var ckplayer_f_ad_l="'.$config['ckplayer_f_ad_l'].'";';
		$player .='var ckplayer_f_ad_s="'.$config['ckplayer_f_ad_s'].'";';
		$player .='var ckplayer_first_pic="'.$config['ckplayer_first_pic'].'";';
		$player .='var ckplayer_buffer_ad="'.$config['ckplayer_buffer_ad'].'";';
		$player .= 'var ckplayer_f_ad="'.$config['ckplayer_f_ad'].'";';
		
		if ($from == true)
		{
			$player .='var url_html_play='.$url_html_play.';';
			$player .='var html_file_suffix="'.$html_file_suffix.'";';
		}else{
			$player .='var html_file_suffix="'.$config_old['html_file_suffix'].'";';
			$url_html_play = $config_old['url_html'] ? $config_old['url_html_play'] : 0;
			$player .='var url_html_play='.$url_html_play.';';
		}
		$player .="var playlistArr = new Array('baidu','qvod','sohu','tudou','youku','qiyi','letv','ck','sina');";
		$player .="\n";
		
		//$player .='if(!window.ActiveXObject){alert(\'请使用IE内核浏览器观看本站影片!\');}'."\n";
		write_file('./temp/Js/player.js',$player);	
		if ($from == false) $this->updateconfig($config);
	}
}
?>