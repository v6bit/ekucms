<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>模板编辑</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<head>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<form id="gxform" action="?s=Admin/Tpl/Update" method="post" name="gxform">
<input name="filename" type="hidden" value="<?php echo ($filename); ?>">
<tr class="table_title">
<td colspan="2"><h2>模板编辑：<input type="text" value="<?php echo ($filename); ?>" size="50" disabled></h2></td>
</tr>
<tr align="center" class="tr">
<td ><textarea name="content" style="width:100%;height:420px"><?php echo (htmlspecialchars($content)); ?></textarea></td>
</tr>
<tr class="tr">
<td ><input class="bginput" type="submit" name="submit" value="提交"> <input class="bginput" type="reset" name="Input" value="重置" ></td>
</tr>
</form>
</table>{__NOTOKEN__}
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