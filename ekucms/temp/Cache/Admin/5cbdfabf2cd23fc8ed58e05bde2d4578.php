<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>后台用户管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
</head>
<body class="body">
<table width="98%" border="0" cellpadding="5" cellspacing="1" class="table">
  <thead>
    <tr class="list_head">
      <th width="342" class="r" style="text-align:left; padding-left:10px">关键字</th>
      <th width="666" align="left" class="r">对应链接地址</th>
      <th width="90" align="center" class="r">打开方式</th>
      <th width="72" align="center" class="r">管理操作</th>
    </tr>
  </thead>

<?php if(($treecount > 0)): ?><form action="?s=Admin-Cat-Updateall" method="post" name="myform" id="myform"> 
  <?php if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$eku): ++$i;$mod = ($i % 2 )?><tbody>
  <tr class="tr">
    <td class="r pd">
    <a href="<?php echo ($eku["link"]); ?>" target="_blank"><?php echo ($eku["name"]); ?></a></td>
    <td align="left"><a href="<?php echo ($ppvod["link"]); ?>" target="_blank"><?php echo ($eku["link"]); ?></a></td>
    <td align="center" class="r ct"><?php echo ($eku["target"]); ?></td>
    <td class="r ct"><a href="?s=Admin/Wei/linkkeyadd/id/<?php echo ($eku["id"]); ?>" title="修改分类">编辑</a> <a href="?s=Admin/Wei/DelLinkKey/id/<?php echo ($eku["id"]); ?>" onClick="return confirm('确定删除?')" title="删除分类">删除</a> </td>
  </tr>
  </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
  <tfoot>
    </tfoot>
  </form>
  <tr class="tr pages"><td colspan="4"><?php echo ($listpages); ?></td></tr>

<?php else: ?>
  <tbody>
  <tr class="tr">
    <td class="r pd" colspan="4" style="text-align:center; color:#F00; font-size:14px;">易酷提醒您：您还没有添加任何内链关键字！ <a href="./index.php?s=Admin/Wei/linkkeyadd" style="color:#00F; text-decoration:underline;">我要添加</a></td>
  </tr></tbody><?php endif; ?>
</table>

</body>
</html>