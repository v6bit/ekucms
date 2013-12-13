<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>添加/编辑用户资料</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
</head>
<body>
<?php if(($id)  >  "0"): ?><form action="?s=Admin/User/Update" method="post" name="gxform" id="gxform">
<input type="hidden" name="id" value="<?php echo ($id); ?>">
<?php else: ?>
<form action="?s=Admin/User/Insert" method="post" name="gxform" id="gxform"><?php endif; ?>  
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<tr class="table_title"><td colspan="4"><?php echo ($tpltitle); ?>用户资料</td></tr>
<tr class="tr rt">
<td width="100">会员帐号：</td>
<td colspan="3" class="lt"><input type="text" name="username" maxlength="150" style="width:200px" value="<?php echo ($username); ?>"> *</td>
</tr>
<tr class="tr rt">
<td >会员邮箱：</td>
<td colspan="3"class="lt"><input type="text" name="email" maxlength="50" style="width:200px" value="<?php echo ($email); ?>"> *</td></tr> 
<tr class="tr rt">
<td >会员密码：</td>
<td colspan="3"class="lt"><input type="password" name="userpwd" maxlength="20" style="width:200px"> <?php if(($id)  >  "0"): ?>不修改密码请留空<?php else: ?>*<?php endif; ?></td>
</tr>
<tr class="tr rt">
<td >确认密码：</td>
<td colspan="3"class="lt"><input type="password" name="reuserpwd" maxlength="20" style="width:200px"> <?php if(($id)  >  "0"): ?><?php else: ?>*<?php endif; ?></td>
</tr>
<tr class="tr rt">
<td >提示问题：</td>
<td colspan="3"class="lt"><input type="text" name="question" maxlength="150" style="width:200px" value="<?php echo ($question); ?>"> *</td>
</tr> 
<tr class="tr rt">
<td >提示答案：</td>
<td colspan="3"class="lt"><input type="text" name="answer" maxlength="150" style="width:200px" value="<?php echo ($answer); ?>"> *</td>
</tr>
<tr class="tr rt">
<td >帐号状态：</td>
<td colspan="3"class="lt"><input type="radio" name="status" value="1" checked style="border:none"/>正常&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0" style="border:none" <?php if(($status)  ==  "0"): ?>checked<?php endif; ?>/> 锁定</td>
</tr> 
<tr class="tr rt">
<td >消费模式：</td>
<td colspan="3"class="lt"><input type="radio" name="pay" id="user_pay_1" value="0" checked style="border:none"/>扣点&nbsp;&nbsp;&nbsp;<input type="radio" name="pay" id="user_pay_2" value="1" style="border:none" <?php if(($pay)  ==  "1"): ?>checked<?php endif; ?>/> 包月</td>
</tr>
<tr class="tr rt">
<td >剩余点数：</td>
<td colspan="3"class="lt"><input type="text" name="money" maxlength="8" style="width:200px" value="<?php echo ($money); ?>"></td>
</tr>
<tr class="tr rt">
<td >到期时间：</td>
<td colspan="3"class="lt"><input type="text" name="duetime" maxlength="50" style="width:200px" value="<?php echo (date('Y-m-d H:i:s',$duetime)); ?>"></td>
</tr>
<tr class="tr rt">
<td >会员QQ：</td>
<td colspan="3"class="lt"><input type="text" name="qq" maxlength="12" style="width:200px" value="<?php echo ($qq); ?>"></td>
</tr> 
<?php if(($id)  >  "0"): ?><tr class="tr rt">
<td >注册时间：</td>
<td colspan="3"class="lt"><input type="text" name="jointime" maxlength="150" style="width:200px" value="<?php echo (date('Y-m-d H:i:s',$jointime)); ?>"></td>
</tr>
<tr class="tr rt">
<td >最后登录时间：</td>
<td colspan="3"class="lt"><input type="text" name="logtime" maxlength="150" style="width:200px" value="<?php echo (date('Y-m-d H:i:s',$logtime)); ?>"></td>
</tr>  
<tr class="tr rt">
<td >注册IP：</td>
<td colspan="3"class="lt"><input type="text" name="joinip" maxlength="150" style="width:200px" value="<?php echo ($joinip); ?>"></td>
</tr>     
<tr class="tr rt">
<td >最后登录IP：</td>
<td colspan="3"class="lt"><input type="text" name="logip" maxlength="150" style="width:200px" value="<?php echo ($logip); ?>"></td>
</tr>
<tr class="tr rt">
<td >登录次数：</td>
<td colspan="3"class="lt"><input type="text" name="lognum" maxlength="150" style="width:200px" value="<?php echo ($lognum); ?>"></td>
</tr><?php endif; ?>
<tr class="tr lt">
<td colspan="4"><?php if(($id)  >  "0"): ?><input class="bginput" type="submit" name="submit" value=" 修 改" ><?php else: ?><input class="bginput" type="submit" name="submit" value="提 交"><?php endif; ?></td>
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