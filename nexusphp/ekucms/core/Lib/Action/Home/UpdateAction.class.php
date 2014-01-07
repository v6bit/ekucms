<?php
/**
 * @name    点击次数模块
 * @package GXCMS.Administrator
 *
 */
class UpdateAction extends HomeAction{

	public function index()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>光线1.5一键升级与易酷CMS</title>
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
    <p>光线1.5 一键升级易酷CMS影视系统</p>
    <p style="color:#F00;">提醒：升级前请备份原代码</p>
    <a href="/index.php?s=Update/updatedo" style=" text-decoration:none;width:120px; height:36px; line-height:36px; background-color:#039; color:#FFF; font-size:14px; padding:10px; cursor:pointer;">
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
<title>光线1.5一键升级与易酷CMS</title>
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
		
		echo '正在升级至易酷影视系统<Br>----------------------------------------<Br>';
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
		$sql = read_file('./up.sql');
		$sql = str_replace('gx_',C('db_prefix'),$sql);
		//echo $sql;exit;
		$return	=	$this->installsql($sql,$db_config);
		if ($return)
		{
			echo '&nbsp;&nbsp;1,SQL更新完成<Br>';
		}else{
			echo '&nbsp;&nbsp;1,SQL更新失败<Br>';
		}
		touch(RUNTIME_PATH.'Install/up.lock');
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
	public function installsql($sql,$db_config){
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
	
	

}

?>