<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>评论信息管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<form id="gxform" action="?s=Admin/Comment/Show" method="post" name="gxform">
<tr class="table_title"><td colspan="9">评论信息列表</td></tr>
<tr class="tr">
<td colspan="9"><input name="wd" onFocus="this.value=''" onBlur="if(this.value=='')this.value='可搜索(用户IP,用户呢称,评论内容)'" type="text" size="35" maxlength="50" value="<?php echo (($wd)?($wd):'可搜索(用户IP,用户呢称,评论内容)'); ?>" style="color:#999;">&nbsp;<input name="type" type="hidden" value="other"><input type="submit" value="搜 索" class="bginput" /></td>
</tr> 
<tr class="list_head ct">
  <td width="60">编号</td>
  <td width="200">视频名称</td>
  <td >评论内容</td>
  <td width="40">查看</td>
  <td width="100">用户名</td> 
  <td width="80">用户IP</td>   
  <td width="80">时间</td>
  <td width="50">状态</td>
  <td width="70">操作</td>
</tr>
<?php if(is_array($list_comment)): $i = 0; $__LIST__ = $list_comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr ct">
  <td class="lt"><input name="ids[]" type="checkbox" value="<?php echo ($gxcms["id"]); ?>" class="noborder"><?php echo ($gxcms["id"]); ?></td>
  <td width="200" class="lt"><a href="?s=Admin/Comment/Show/wd/<?php echo (remove_xss(htmlspecialchars(urlencode($gxcms["title"])))); ?>"><?php echo ($gxcms["title"]); ?></a></td>
  <td class="lt" style="white-space:normal;"><?php echo (remove_xss(htmlspecialchars(msubstr($gxcms["content"],0,37)))); ?></td>
  <td class="td ct"><img src="./views/images/admin/comment.gif" onClick="dialogPop('?s=Admin/Comment/Showid/id/<?php echo ($gxcms["id"]); ?>','评论详请')" title="查看详细信息" style="cursor:pointer;"></td>
  <td class="td"><a href="?s=Admin/Comment/Show/wd/<?php echo (remove_xss(htmlspecialchars(urlencode($gxcms["username"])))); ?>"><?php echo (remove_xss(htmlspecialchars($gxcms["username"]))); ?></a></td>
  <td class="td"><a href="?s=Admin/Comment/Show/wd/<?php echo ($gxcms["ip"]); ?>"><?php echo ($gxcms["ip"]); ?></a></td>
  <td class="td"><?php echo (date('Y-m-d',$gxcms["addtime"])); ?></td>
  <td class="td"><?php if(($gxcms['status'])  ==  "1"): ?><a href="?s=Admin/Comment/Status/id/<?php echo ($gxcms["id"]); ?>/sid/0" title="已通过审核,点击取消审核">已审</a><?php else: ?><a href="?s=Admin/Comment/Status/id/<?php echo ($gxcms["id"]); ?>/sid/1" title="还没通过审核,点击通过审核"><font color="red">待审</font></a><?php endif; ?></td>
  <td class="td"><a href="?s=Admin/Comment/Add/id/<?php echo ($gxcms["id"]); ?>" title="点击修改评论">修改</a> <a href="?s=Admin/Comment/Del/id/<?php echo ($gxcms["id"]); ?>" onClick="return confirm('确定删除该评论吗?')" title="点击删除评论" >删除</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?> 
<tr class="tr pages"><td colspan="9"><?php echo ($listpages); ?></td></tr>
<tr class="tr"><td colspan="9"><input type="button" id="checkall" value="全/反选" class="bginput">&nbsp;&nbsp;<input type="submit" value="批量审核" class="bginput" onClick="gxform.action='?s=Admin/Comment/Statusall/sid/1';" />&nbsp;&nbsp;<input type="submit" value="取消审核" class="bginput" onClick="gxform.action='?s=Admin/Comment/Statusall/sid/0';" />&nbsp;&nbsp;<input type="submit" value="批量删除" onClick="if(confirm('删除后将无法还原,确定要删除吗?')){gxform.action='?s=Admin/Comment/Delall';}else{return false}"  class="bginput"/>&nbsp;&nbsp;<input type="submit" value="清空评论" onClick="if(confirm('清空数据后将无法还原,确定要清空吗?')){gxform.action='?s=Admin/Comment/Delclear';}else{return false}" class="bginput"/></td></tr> 
</form>
</table>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery_jqmodal.js"></script>
<link rel='stylesheet' type='text/css' href='./views/css/jquery_jqmodal.css'>
<style>#dia_title{height:25px;line-height:25px}.jqmWindow{height:200px;}</style>
<div class="jqmWindow" id="dialog">
<div id="dia_title"><span class="jqmTitle"></span><a href="javascript:void(0)" class="jqmClose" title="关闭窗口"></a></div>
<div id="dia_content"></div>
</div>
<script language="JavaScript" type="text/javascript">
//弹出浮动层 $('#dialog').jqm({modal: true, trigger: 'a.showDialog'});
$('#dialog').jqm({modal: false, trigger: '#window' , opacity:'0.1'});
</script>
<style>#dia_title{height:25px;line-height:25px}.jqmWindow{height:300px;width:500px;}</style>
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