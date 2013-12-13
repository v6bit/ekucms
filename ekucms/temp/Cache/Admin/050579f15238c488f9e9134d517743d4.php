<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>多分类系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<style>input{ height:25px;line-height:20px};</style>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<?php if(($m_cid)  >  "0"): ?><form id="gxform" name="update" action="?s=Admin/Stype/Update" method="post">
<input type="hidden" name="m_cid" value="<?php echo ($m_cid); ?>">
<?php else: ?>
<form id="gxform" action="?s=Admin/Stype/Insert" method="post" name="gxform"><?php endif; ?>
<tr class="table_title">
  <td colspan="2"><?php echo ($tpltitle); ?>多分类</td>
</tr>      
<tr class="tr">
  <td width="100" class="rt">现有分类：</td>
  <td>
  <select name="m_list_id" id="m_list_id" class="w120">
  <option value="0">现有分类</option>
  <?php if(is_array($list_tree)): $i = 0; $__LIST__ = $list_tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvod): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($ppvod["id"]); ?>" <?php if(($ppvod["id"])  ==  $m_list_id): ?>selected<?php endif; ?>><?php echo ($ppvod["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
  </select>
   *</td>
</tr>
 <tr class="tr">
  <td class="rt">栏目中文名称：</td>
  <td ><input name="m_name" type="text" id="m_name" style="width:100px" value="<?php echo ($m_name); ?>" maxlength="100"> *</td>
</tr>  
<tr class="tr">
  <td class="rt">栏目排序：</td>
  <td ><input name="m_order" type="text" id="m_order" style="width:45px;height:18px;line-height:18px;text-align:center" title="越小越前面" value="<?php echo ($m_order); ?>" maxlength="2"></td>
</tr>
<tr class="tr">
  <td colspan="2"><input class="bginput" type="submit" name="submit" value="提交"></td>
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