<?php
/**
 * @name    点击次数模块
 * @package GXCMS.Administrator
 *
 */
class Update24Action extends HomeAction{

	public function index()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>易酷2.3一键升级至 2.4 版本</title>
<style type="text/css">

body {
	font-size: 12px;
	padding:0px; margin:0px;
}
</style>
</head>

<body>
<table width="480" border="0" align="center" cellpadding="5" cellspacing="1" style="margin-top:50px; background-color:#F60">
  <tr>
    <td height="120" align="center" style="background-color:#FC6">
    <p>易酷 <strong style="font-size:16px;color:#F00;">2.3</strong>一键升级至 <strong style="font-size:16px;color:#F00;">2.4</strong> 版本</p>
    <p style="color:#F00;">提醒：升级前请备份原代码</p>
    <a href="/index.php?s=Update24/updatedo" style=" text-decoration:none;width:120px; height:36px; line-height:36px; background-color:#039; color:#FFF; font-size:14px; padding:10px; cursor:pointer;">
    一键升级
    </a>
    </td>
  </tr>
</table>
</body>
</html>
';
	}	

	public function Updatedo()
	{
		
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>易酷2.3一键升级至 2.4 版本</title>
<style type="text/css">

body {
	font-size: 12px;
	padding:0px; margin:0px;
}
</style>
</head>

<body>
<table width="480" border="0" align="center" cellpadding="5" cellspacing="1" style="margin-top:50px; background-color:#F60">
  <tr>
    <td height="120" style="background-color:#FC6">
';
		
		echo '正在升级易酷免费影视系统<Br>----------------------------------------<Br>';
		// 获取配置文件
		$config = array(
			'db_host'  =>C('db_host'),
			'db_name'  =>C('db_name'),
			'db_user'  =>C('db_user'), 
			'db_pwd'   =>C('db_pwd'),
			'db_port'  =>C('db_port'),
			'db_prefix'=>C('db_prefix'),
		);


		// 导入SQL安装脚本
		$db_config = array('dbms'=>'mysql','username'=>$config['db_user'],'password'=>$config['db_pwd'],'hostname'=>$config['db_host'],'hostport'=>$config['db_port'],'database'=>$config['db_name']);	
		$sql = read_file('./up24.sql');
		$sql = str_replace('eku_',C('db_prefix'),$sql);
		//echo $sql;exit;
		$return	=	$this->installsql($sql,$db_config);
		if ($return)
		{
			echo '&nbsp;&nbsp;1,SQL更新完成<Br>';
		}else{
			echo '&nbsp;&nbsp;1,SQL更新失败<Br>';
		}
		
		//更新配置文件
		$return	=	$this->updateConfig();
		if ($return)
		{
			echo '&nbsp;&nbsp;2,配置文件更新完成<Br>';
		}else{
			echo '&nbsp;&nbsp;2,配置文件更新失败<Br>';
		}
		touch(RUNTIME_PATH.'Install/up24.lock');
		@unlink('./temp/~app.php');
		@unlink('./temp/~runtime.php');	
		echo('----------------------------------------<Br>升级结束<Br><Br>');//数据导入完毕
		echo '<a href="/">进入主页</a>&nbsp;&nbsp;';
		echo '<a href="index.php?s=Admin/Index">进入后台</a>';
	echo '</td>
  </tr>
</table>
</body>
</html>
';	
		
	}
	
	//  执行sql语句
	private function installsql($sql,$db_config){
		require THINK_PATH.'/Lib/Think/Db/Driver/DbMysql.class.php';
		$db = new Dbmysql($db_config);
		$sql = str_replace("\r\n", "\n", $sql); 
		$ret = array(); 
		$num = 0; 
		foreach(explode(";\n", trim($sql)) as $query){
			$queries = explode("\n", trim($query)); 
			foreach($queries as $query) {
				$ret[$num] .= $query[0] == '#' || $query[0].$query[1] == '--' ? '' : $query; 
			} $num++; 
		} 
		unset($sql); 
		foreach($ret as $query) {  
			if(trim($query)) { 
			    $db->query($query); 
			} 
		}
		return true; 
	}								
	
	private function updateConfig()
	{
		$config_old = require './config.php';
		$config_old['index_hdp_show']	=	0;//是否开启hdp
		//下面是伪静态相关设置
		$config_old['rewrite_videolist']	=	'';
		$config_old['rewrite_videodetail']	=	'';
		$config_old['rewrite_videosearch']	=	'';
		$config_old['rewrite_videotag']	=	'';
		$config_old['rewrite_newslist']	=	'';
		$config_old['rewrite_newsinfo']	=	'';
		$config_old['rewrite_newstag']	=	'';
		$config_old['rewrite_speciallist']	=	'';
		$config_old['rewrite_specialdetail']	=	'';
		$config_old['rewrite_guestbook']	=	'';
		$config_old['rewrite_map']	=	'';
		$config_old['rewrite_videoplay']	=	'';
		$config_old['seo_movie_title']	=	'';
		$config_old['seo_movie_keywords']	=	'';
		$config_old['seo_movie_desc']	=	'';
		arr2file('./config.php',$config_old);
		return true;
	}
}
?>