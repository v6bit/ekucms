<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<title>专题管理</title>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>



<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>



<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>



</head>



<body>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="87%" valign="top"><table width="98%" border="0" cellpadding="5" cellspacing="1" class="table">
      
      <tr class="table_title">
        
        <td colspan="3">网站手工分类 
          <input type="button" name="button" id="button" value="添加首工分类" onclick="window.location='./index.php?s=Admin/Self/TypeAdd'" /></td>
        
        </tr>
      
      <tr>
        
        <td colspan="3">全部
          
          </td>
        
        </tr>
      
      <tr class="list_head ct">
        
        <td width="109">编号
          
          <eq name="order" value="id desc"></eq></td>
        
        <td width="751" align="left">&nbsp;&nbsp;分类名称</td>
        
        <td width="162">操作</td>
        
        </tr>
      
      <form action="?s=Admin/Special/Delall" method="post" id="gxform" name="gxform">
        
        <?php
       	foreach($list as $gxcms){
        	if ($gxcms['fid'] == 0){
        ?>
           <tr class="tr" onmouseover="this.style.backgroundColor='#EFEFEF';" onmouseout="this.style.backgroundColor='#FFFFFF';">
            <td align="center"><?php echo ($gxcms["id"]); ?></td>
            <td align="left"><strong><?php echo ($gxcms["name"]); ?></strong></td>
            <td class="td ct"><a href="?s=Admin/Self/TypeAdd/id/<?php echo ($gxcms["id"]); ?>"  title="点击修改专题">编辑</a> <a href="?s=Admin/Self/DelType/id/<?php echo ($gxcms["id"]); ?>" onclick="return confirm('确定删除该手工分类吗?')"  title="点击删除">删除</a></td>
           </tr>
        <?php
            }
            foreach($list as $gxcmss){
                if ($gxcmss['fid'] == $gxcms['id'])
                {
        ?>
           <tr class="tr" onmouseover="this.style.backgroundColor='#EFEFEF';" onmouseout="this.style.backgroundColor='#FFFFFF';">
            <td align="center"><?php echo ($gxcmss["id"]); ?></td>
            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp; |- <a href="?s=Admin/Self/Mana/cid/<?php echo ($gxcmss["id"]); ?>"><?php echo ($gxcmss["name"]); ?></a></td>
            <td class="td ct"><a href="?s=Admin/Self/TypeAdd/id/<?php echo ($gxcmss["id"]); ?>"  title="点击修改专题">编辑</a> <a href="?s=Admin/Self/DelType/id/<?php echo ($gxcmss["id"]); ?>" onclick="return confirm('确定删除该手工分类吗?')"  title="点击删除">删除</a></td>
           </tr>
        <?php
                }
            }
        }
        ?>
        
        </form>
      
    </table></td>

  </tr>

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