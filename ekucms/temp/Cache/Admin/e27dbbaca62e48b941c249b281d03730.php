<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>后台用户列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="3" cellspacing="1" class="table">
<tr class="table_title" ><td colspan="7">系统用户列表</td></tr>
<tr class="list_head ct">
  <td width="50">ID</td>
  <td >用户名</td>
  <td >上次登录时间</td>
  <td >上次登录IP</td>
  <td >登录次数</td>
  <td >操 作</td>
</tr> 
<form id="gxform" action="?s=Admin/Master/Delall" method="post" name="gxform">    
<?php if(is_array($list_master)): $i = 0; $__LIST__ = $list_master;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr">
  <td><input name='ids[]' type='checkbox' value='<?php echo ($gxcms["id"]); ?>' class="noborder"><?php echo ($gxcms["id"]); ?></td>
  <td align="center"><?php echo (htmlspecialchars($gxcms["user"])); ?></td>
  <td align="center"><font color="red"><?php echo (date('Y-m-d H:i:s',$gxcms["logintime"])); ?></font></td>
  <td align="center"><?php echo ($gxcms["loginip"]); ?></td>
  <td align="center"><?php echo ($gxcms["logincount"]); ?></td>
  <td align="center"><a href="?s=Admin/Master/Add/id/<?php echo ($gxcms["id"]); ?>">编辑</a> <a href="?s=Admin/Master/Del/id/<?php echo ($gxcms["id"]); ?>" onClick="return confirm('确定删除该用户吗?删除后将不能恢复！')">删除</a>
  </td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<tr class="tr">
  <td colspan="7"><input type="button" class="bginput" id="checkall" value="全/反选"> <input class="bginput" type="submit" value="批量删除" onClick="return confirm('删除后将无法还原,确定要删除吗?')"></td>
 </tr>
</form>
</table>
<style>
#footer, #footer a:link, #footer a:visited {
	clear:both;
	color:#0072e3;
	font:12px/1.5 Arial;
	margin-top:10px;
	text-align:center;
	white-space:nowrap;
}
</style>
<div id="footer">程序版本：<?php echo C("cms_var");?>&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2010-2011 All rights reserved</div>
</body>
</html>