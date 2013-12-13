<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>影片采集管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript">
$(document).ready(function(){	
	$('#xmllist').html($('#xml').html());
	$('#xml').html('');
});
var jumpurl = '<?php echo ($jumpurl); ?>';
</script>
</head>
<body>
<table width="98%" cellspacing="1" cellpadding="5" border="0" class="table">
  <tbody>
    <tr class="table_title">
      <td colspan="7"><span style="float:right">资源合作QQ：64041587</span>百度影音资源库列表 
      <?php if(!empty($jumpurl)): ?><a href="<?php echo ($jumpurl); ?>" style="color:#FF0000;font-weight:bold">上次有采集任务没有完成，是否接着采集?</a><?php endif; ?>
      </td>
    </tr>
    <tr class="tr">
      <td>01、</td>
      <td><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/8/xmlurl/http:@@www.bdzy.cc@xml@caiji.asp?ac=list/reurl/http:@@www.bdzy.cc@detail@?">www.bdzy.cc 更新快，片源20000+(请更新到1.4版再采集)</a></td>
      <td class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/8/action/day/h/24/xmlurl/http:@@www.bdzy.cc@xml@caiji.asp?ac=videolist/reurl/http:@@www.bdzy.cc@detail@?">采集当天</a></td>
      <td class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/8/action/day/h/98/xmlurl/http:@@www.bdzy.cc@xml@caiji.asp?ac=videolist/reurl/http:@@www.bdzy.cc@detail@?">采集本周</a></td>
      <td class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/8/action/all/xmlurl/http:@@www.bdzy.cc@xml@caiji.asp?ac=videolist/reurl/http:@@www.bdzy.cc@detail@?">采集所有</a></td>
      <td class="ct"><a title="包括片名,图片,主演,分类等" href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/8/action/all/pic/true/xmlurl/http:@@www.bdzy.cc@xml@caiji.asp?ac=videolist/reurl/http:@@www.bdzy.cc@detail@?">重采资料</a></td>
      <td class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/8/xmlurl/http:@@www.bdzy.cc@xml@caiji.asp?ac=list/reurl/http:@@www.bdzy.cc@detail@?">绑定分类</a></td>
    </tr>
    <tr class="tr">
      <td width="20">02、</td>
      <td><a href="?s=Admin/Collect/Gxcms/ziyuan/feifei/fid/9/inputer/gxcms/play/bdhd/h/1/xmlurl/http:@@www.kuaicj.com/reurl/http:@@www.kuaicj.com@vod@">www.kuaicj.com 资源丰富，片源16000+</a></td>
      <td width="70" class="ct"><a onclick="return confirm('分类绑定过了吗？');" href="?s=Admin/Collect/Gxcms/ziyuan/feifei/fid/9/inputer/gxcms/play/bdhd/action/day/h/24/xmlurl/http:@@www.kuaicj.com/reurl/http:@@www.kuaicj.com@vod@">采集当天</a></td>
      <td width="70" class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/feifei/fid/9/inputer/gxcms/play/bdhd/action/day/h/98/xmlurl/http:@@www.kuaicj.com/reurl/http:@@www.kuaicj.com@vod@">采集本周</a></td>
      <td width="70" class="ct"><a onclick="return confirm('分类绑定过了吗？');" href="?s=Admin/Collect/Gxcms/ziyuan/feifei/fid/9/inputer/gxcms/play/bdhd/action/all/xmlurl/http:@@www.kuaicj.com">采集所有</a></td>
      <td width="70" class="ct"><a title="包括片名,图片,主演,分类等" href="?s=Admin/Collect/Gxcms/ziyuan/feifei/fid/9/inputer/gxcms/play/bdhd/action/all/pic/true/xmlurl/http:@@www.kuaicj.com/reurl/http:@@www.kuaicj.com@vod@">重采资料</a></td>
      <td width="70" class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/feifei/fid/9/inputer/gxcms/play/bdhd/h/1/xmlurl/http:@@www.kuaicj.com/reurl/http:@@www.kuaicj.com@vod@">绑定分类</a></td>
    </tr>
    <tr class="tr">
      <td>03、</td>
      <td><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/10/xmlurl/http:@@www.bdhdzy.cc@xml@max4.0.asp?ac=list/reurl/http:@@www.bdhdzy.cc@detail@?">www.bdhdzy.cc 更新快，片源12000+</a></td>
      <td class="ct"><a onclick="return confirm('分类绑定过了吗？');" href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/10/action/day/h/24/xmlurl/http:@@www.bdhdzy.cc@xml@max4.0.asp?ac=videolist/reurl/http:@@www.bdhdzy.cc@detail@?">采集当天</a></td>
      <td class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/10/action/day/h/98/xmlurl/http:@@www.bdhdzy.cc@xml@max4.0.asp?ac=videolist/reurl/http:@@www.bdhdzy.cc@detail@?">采集本周</a></td>
      <td class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/10/action/all/xmlurl/http:@@www.bdhdzy.cc@xml@max4.0.asp?ac=videolist/reurl/http:@@www.bdhdzy.cc@detail@?">采集所有</a></td>
      <td class="ct"><a title="包括片名,图片,主演,分类等" href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/10/action/all/pic/true/xmlurl/http:@@www.bdhdzy.cc@xml@max4.0.asp?ac=videolist/reurl/http:@@www.bdhdzy.cc@detail@?">重采资料</a></td>
      <td class="ct"><a href="?s=Admin/Collect/Gxcms/ziyuan/a/fid/10/xmlurl/http:@@www.bdhdzy.cc@xml@max4.0.asp?ac=list/reurl/http:@@www.bdhdzy.cc@detail@?">绑定分类</a></td>
    </tr>
  </tbody>
</table>




<table width="98%" cellspacing="1" cellpadding="5" border="0" class="table">
  <tbody>
    <tr class="table_title">
      <td colspan="7"><span style="float:right">资源合作QQ:64041587</span>快播资源库列表
<?php if(!empty($jumpurl_qvod)): ?><a href="<?php echo ($jumpurl_qvod); ?>" style="color:#FF0000;font-weight:bold">上次有采集任务没有完成，是否接着采集?</a><?php endif; ?></td>
    </tr>
    <tr class="tr">
      <td width="20">01、</td>
      <td><a href="/index.php?s=Admin/Xml/Caijia/fid/21/xmlurl/http:||www.hakuzy.com|xml|maxresxml.asp?ac@list/reurl/http:||www.haozy.me|Data.asp?DataId=">『QVOD』www.hakuzy.com 24小时不间断更新，片源20000+</a></td>
      <td width="70" class="ct"><a href="/index.php?s=Admin/Xml/Caijia/action/day/fid/21/xmlurl/http:||www.hakuzy.com|xml|maxresxml.asp?ac@list/reurl/http:||www.haozy.me|Data.asp?DataId=/vodids//play//inputer//cid//wd//h/24">采集当天</a></td>
      <td width="70" class="ct"><a href="" style="color:#666">采集本周</a></td>
      <td width="70" class="ct"><a href="?s=Admin/Xml/Caijia/action/all/fid/21/xmlurl/http:||www.hakuzy.com|xml|maxresxml.asp?ac@list/reurl/http:||www.haozy.me|Data.asp?DataId=/vodids//play//inputer//cid//wd/">采集所有</a></td>
      <td width="70" class="ct"><a title="包括片名,图片,主演,分类等" href="?s=Admin/Xml/Caijia/action/all/fid/21/pic/1/xmlurl/http:||www.hakuzy.com|xml|maxresxml.asp?ac@videolist/reurl/http:||www.haozy.me|Data.asp?DataId=">重采资料</a></td>
      <td width="70" class="ct"><a href="/index.php?s=Admin/Xml/Caijia/fid/21/xmlurl/http:||www.hakuzy.com|xml|maxresxml.asp?ac@list/reurl/http:||www.haozy.me|Data.asp?DataId=">绑定分类</a></td>
    </tr>
    <tr class="tr">
      <td>02、</td>
      <td><a href="?s=Admin/Xml/Caijia/fid/26/xmlurl/http:||api.265zy.com|xml|max.asp?ac@list/reurl/http:||www.haozy.com|Data.asp?DataId=">『QVOD』www.265zy.com 24小时不间断更新，片源20000+</a></td>
      <td class="ct"><a href="?s=Admin/Xml/Caijia/action/day/fid/26/xmlurl/http:||api.265zy.com|xml|max.asp?ac@videolist/h/24/reurl/http:||www.haozy.com|Data.asp?DataId=">采集当天</a></td>
      <td class="ct"><a href="" style="color:#666">采集本周</a></td>
      <td class="ct"><a href="?s=Admin/Xml/Caijia/action/all/fid/26/xmlurl/http:||api.265zy.com|xml|max.asp?ac@videolist/h//reurl/http:||www.haozy.com|Data.asp?DataId=">采集所有</a></td>
      <td class="ct"><a title="包括片名,图片,主演,分类等" href="?s=Admin/Xml/Caijia/action/all/fid/21/pic/1/xmlurl/http:||www.hakuzy.com|xml|maxresxml.asp?ac@videolist/reurl/http:||www.haozy.me|Data.asp?DataId=">重采资料</a></td>
      <td class="ct"><a href="/index.php?s=Admin/Xml/Caijia/fid/26/xmlurl/http:||api.265zy.com|xml|max.asp?ac@list/reurl/http:||www.haozy.com|Data.asp?DataId=">绑定分类</a></td>
    </tr>
    <tr class="tr">
      <td>03、</td>
      <td><a href="/index.php?s=Admin/Xml/Feifei/fid/29/h/1/xmlurl/http:||www.qvodzi.com|/reurl/http:||www.qvodzi.com|vod?id=">『QVOD』www.qvodzi.com 24小时不间断更新,两组播放地址</a></td>
      <td class="ct"><a href="/index.php?s=Admin/Xml/Feifei/action/day/fid/29/xmlurl-http:||www.qvodzi.com|/reurl/http:||www.qvodzi.com|vod?id=/h/24">采集当天</a></td>
      <td class="ct"><a href="" style="color:#666">采集本周</a></td>
      <td class="ct"><a href="/index.php?s=Admin/Xml/Feifei/action/all/fid/29/xmlurl-http:||www.qvodzi.com|/reurl/http:||www.qvodzi.com|vod?id=/h/24">采集所有</a></td>
      <td class="ct"><a title="包括片名,图片,主演,分类等" href="?s=Admin/Xml/Caijia/action/all/fid/21/pic/1/xmlurl/http:||www.hakuzy.com|xml|maxresxml.asp?ac@videolist/reurl/http:||www.haozy.me|Data.asp?DataId=">重采资料</a></td>
      <td class="ct"><a href="/index.php?s=Admin/Xml/Feifei/fid/29/h/1/xmlurl/http:||www.qvodzi.com|/reurl/http:||www.qvodzi.com|vod?id=">绑定分类</a></td>
    </tr>
    <tr class="tr">
      <td>04、</td>
      <td><a href="/index.php?s=Admin/Xml/Caijia/fid/20/xmlurl/http:||www.zyqvod.com|api|max.asp?ac@list/reurl/http:||www.qvodzy.com.cn|movie.asp?ID=">『QVOD』www.qvodzy.me 24小时不间断更新，片源20000+</a></td>
      <td class="ct"><a href="/index.php?s=Admin/Xml/Caijia/action/day/fid/20/xmlurl/http:||www.zyqvod.com|api|max.asp?ac@videolist/h/24/reurl-http:||www.qvodzy.com.cn|movie.asp?ID=">采集当天</a></td>
      <td class="ct"><a href="" style="color:#666">采集本周</a></td>
      <td class="ct"><a href="/index.php?s=Admin/Xml/Caijia/action/all/fid/20/xmlurl/http:||www.zyqvod.com|api|max.asp?ac@videolist/h//reurl-http:||www.qvodzy.com.cn|movie.asp?ID=">采集所有</a></td>
      <td class="ct"><a title="包括片名,图片,主演,分类等" href="?s=Admin/Xml/Caijia/action/all/fid/21/pic/1/xmlurl/http:||www.hakuzy.com|xml|maxresxml.asp?ac@videolist/reurl/http:||www.haozy.me|Data.asp?DataId=">重采资料</a></td>
      <td class="ct"><a href="/index.php?s=Admin/Xml/Caijia/fid/20/xmlurl/http:||www.zyqvod.com|api|max.asp?ac@list/reurl/http:||www.qvodzy.com.cn|movie.asp?ID=">绑定分类</a></td>
    </tr>
  </tbody>
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
<div id="footer">程序版本：<?php echo C("cms_var");?>&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2010-2011 All rights reserved</div> <span id="xml">
</span>
</body>
</html>