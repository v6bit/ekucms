<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>后台用户添加与编辑</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
</head>
<body>
<?php if(($id)  >  "0"): ?><form id="gxform" name="update" action="?s=Admin/Master/Update" method="post">
<input type="hidden" name="id" value="<?php echo ($id); ?>">
<input type="hidden" name="pwd2" value="<?php echo ($pwd); ?>">
<?php else: ?>
<form id="gxform" name="add" action="?s=Admin/Master/Insert" method="post"><?php endif; ?>  
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<tr class="table_title">
  <td colspan="2"><?php echo ($tpltitle); ?>系统用户</td>
</tr>
<tr class="tr">
  <td width="100" class="rt">用户名称：</td>
  <td ><input name="user" type="text" value="<?php echo ($user); ?>" class="w200" maxlength="12" <?php if(($id)  >  "0"): ?>disabled<?php endif; ?>> *最大12个字符</td>
</tr>
<tr class="ji">
  <td class="rt">用户密码：</td>
  <td><input name="pwd" type="password" class="w200" maxlength="12"> <?php if(($id)  >  "0"): ?>不修改密码请留空<?php else: ?>*最大12个字符<?php endif; ?></td>
</tr>
<tr class="tr">
  <td class="rt">确定密码：</td>
  <td><input name="repwd" type="password" class="w200" maxlength="12"> <?php if(($id)  >  "0"): ?><?php else: ?>*<?php endif; ?></td>
</tr>
<tr class="ji">
  <td class="rt">用户权限：</td>
  <td ><!--id="checkContainor" -->
  <input name="usertype[0]" type="checkbox" value="1" class="noborder" <?php if(($usertype["0"])  ==  "1"): ?>checked<?php endif; ?>>参数配置
  <input name="usertype[1]" type="checkbox" value="1" class="noborder" <?php if(($usertype["1"])  ==  "1"): ?>checked<?php endif; ?>>缓存管理
  <input name="usertype[2]" type="checkbox" value="1" class="noborder" <?php if(($usertype["2"])  ==  "1"): ?>checked<?php endif; ?>>后台用户
  <input name="usertype[3]" type="checkbox" value="1" class="noborder" <?php if(($usertype["3"])  ==  "1"): ?>checked<?php endif; ?>>栏目管理
  <input name="usertype[4]" type="checkbox" value="1" class="noborder" <?php if(($usertype["4"])  ==  "1"): ?>checked<?php endif; ?>>影视管理
  <input name="usertype[5]" type="checkbox" value="1" class="noborder" <?php if(($usertype["5"])  ==  "1"): ?>checked<?php endif; ?>>文章管理
  <input name="usertype[6]" type="checkbox" value="1" class="noborder" <?php if(($usertype["6"])  ==  "1"): ?>checked<?php endif; ?>>专题管理
  <input name="usertype[7]" type="checkbox" value="1" class="noborder" <?php if(($usertype["7"])  ==  "1"): ?>checked<?php endif; ?>>采集管理  
  <input name="usertype[8]" type="checkbox" value="1" class="noborder" <?php if(($usertype["8"])  ==  "1"): ?>checked<?php endif; ?>>用户管理
  <input name="usertype[9]" type="checkbox" value="1" class="noborder" <?php if(($usertype["9"])  ==  "1"): ?>checked<?php endif; ?>>观看记录<br>
  <input name="usertype[10]" type="checkbox" value="1" class="noborder" <?php if(($usertype["10"])  ==  "1"): ?>checked<?php endif; ?>>评论管理
  <input name="usertype[11]" type="checkbox" value="1" class="noborder" <?php if(($usertype["11"])  ==  "1"): ?>checked<?php endif; ?>>留言管理
  <input name="usertype[12]" type="checkbox" value="1" class="noborder" <?php if(($usertype["12"])  ==  "1"): ?>checked<?php endif; ?>>模板管理
  <input name="usertype[13]" type="checkbox" value="1" class="noborder" <?php if(($usertype["13"])  ==  "1"): ?>checked<?php endif; ?>>广告管理 
  <input name="usertype[14]" type="checkbox" value="1" class="noborder" <?php if(($usertype["14"])  ==  "1"): ?>checked<?php endif; ?>>友链管理   
  <input name="usertype[15]" type="checkbox" value="1" class="noborder" <?php if(($usertype["15"])  ==  "1"): ?>checked<?php endif; ?>>附件管理
  <input name="usertype[16]" type="checkbox" value="1" class="noborder" <?php if(($usertype["16"])  ==  "1"): ?>checked<?php endif; ?>>静态生成
  <input name="usertype[17]" type="checkbox" value="1" class="noborder" <?php if(($usertype["17"])  ==  "1"): ?>checked<?php endif; ?>>数据库管理
  <input name="usertype[18]" type="checkbox" value="1" class="noborder" <?php if(($usertype["18"])  ==  "1"): ?>checked<?php endif; ?>>幻灯管理
  <span></span>
  </td>
</tr> 
<tr class="tr">
  <td colspan="2"><input class="bginput" type="submit" name="submit" value="提交"> <input class="bginput" type="reset" name="Input" value="重置" ></td>
</tr>
</table>
</form>
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