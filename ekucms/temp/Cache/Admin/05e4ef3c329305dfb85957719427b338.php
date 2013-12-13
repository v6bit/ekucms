<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<title>手工管理</title>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>



<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>



<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_all.js"></script>



</head>



<body>



<table width="98%" border="0" cellspacing="1" cellpadding="5">
  <tr>
    <td align="left"><input type="button" name="button" id="button" value="  添加手工  " onclick="window.location='./index.php?s=Admin/Self/Add';" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="13%" align="left" valign="top" bgcolor="#F2F9FD">

    

     <table width="100%" border="0" cellspacing="0" cellpadding="0">

       <tr>

         <td style="color:#FFF; height:24px; padding-left:5px;"><a href="?s=Admin/Self/Mana/"><strong>全部手工</strong></a></td>

       </tr>

        <?php
       	foreach($list_type as $gxcms){
        	if ($gxcms['fid'] == 0){
        ?>
           <tr><td style="color:#000; height:24px; padding-left:5px;"><?php echo ($gxcms['name']); ?></td></tr>
        <?php
            }
            foreach($list_type as $gxcmss){
                if ($gxcmss['fid'] == $gxcms['id'])
                {
        ?>
           <tr><td style="color:#000; height:24px; padding-left:5px;">&nbsp;&nbsp;|--<a href="?s=Admin/Self/Mana/cid/<?php echo ($gxcmss['id']); ?>"><?php echo ($gxcmss['name']); ?></a></td></tr>
        <?php
                }
            }
        }
        ?>

     </table>

    </td>

    <td width="87%" valign="top"><table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">

      <tr class="table_title">

        <td colspan="6">网站手工管理</td>

      </tr>

      <tr>

        <td colspan="6">全部

          </td>

      </tr>

      <tr class="list_head ct">

        <td width="96" align="center">编号</td>

        <td width="447" >标 题</td>

        <td width="274" >分类</td>

        <td width="104">排序</td>

        <td width="227">录入时间

          <?php if(($order)  ==  "addtime desc"): ?><a href="?s=Admin/Special/Show/type/addtime/order/asc"><img src="./views/images/admin/up.gif" border="0" alt="点击按时间升序排列" /></a>

            <?php else: ?>

            <a href="?s=Admin/Special/Show/type/addtime/order/desc"><img src="./views/images/admin/down.gif" border="0" alt="点击按时间降序排列" /></a><?php endif; ?></td>

        <td width="100">操作</td>

      </tr>

      <form action="?s=Admin/Special/Delall" method="post" id="gxform" name="gxform">

        <?php if(is_array($list_special)): $i = 0; $__LIST__ = $list_special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr" onmouseover="this.style.backgroundColor='#EFEFEF';" onmouseout="this.style.backgroundColor='#FFFFFF';">

            <td align="center"><?php echo ($gxcms["id"]); ?></td>

            <td align="left"><a href="<?php echo ($gxcms["link"]); ?>" target="_blank" style="color:<?php echo ($gxcms["color"]); ?>"><?php echo htmlspecialchars(msubstr($gxcms['title'].$gxcms['intro'],0,40));?></a></td>

            <td align="left"><a href="?s=Admin/Self/Mana/cid/<?php echo ($gxcms["cid"]); ?>"><?php echo ($gxcms["cname"]); ?></a></td>

            <td class="td ct"><?php echo ($gxcms["orders"]); ?></td>

            <td class="td ct"><?php echo (date('Y-m-d H:i:s',$gxcms["actiontime"])); ?></td>

            <td class="td ct"><a href="?s=Admin/Self/Add/id/<?php echo ($gxcms["id"]); ?>"  title="点击修改专题">编辑</a> <a href="?s=Admin/Self/Del/id/<?php echo ($gxcms["id"]); ?>" onclick="return confirm('确定删除该手工吗?')"  title="点击删除专题">删除</a></td>

          </tr><?php endforeach; endif; else: echo "" ;endif; ?>

        <tr>
          
          <td colspan="6" bgcolor="#FFFFFF"><div class="pages"><?php echo ($listpages); ?></div></td>
          
        </tr>

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