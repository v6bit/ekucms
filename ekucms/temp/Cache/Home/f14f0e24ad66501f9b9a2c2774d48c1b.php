<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($description); ?>">
<title><?php echo ($webtitle); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>
<script language="javascript">
$(document).ready(function(){
	$('#content').focus(function(){
		if($('#content').val()=='分享您的看法吧，最多200个字。'){
			$('#content').val('');
		}
	});
	$('#content').blur(function(){
		if($('#content').val()==''){
			$('#content').val('分享您的看法吧，最多200个字。');
		}
	});	
	$("#guestbook").submit( function () {
		if($('#content').val().length>200){
			alert('您输入的留言信息过长，请删减一些！');
  			return false;
		}
		if($('#content').val()=='分享您的看法吧，最多200个字。'){
			alert('请输入留言信息！');
  			return false;
		}		
	}); 
});
</script>
</head>
<body>
<script language="javascript">var SitePath='<?php echo ($webpath); ?>';var SiteMid='<?php echo ($mid); ?>';var SiteCid='<?php echo ($cid); ?>';var SiteId='<?php echo ($id); ?>';</script>
<!--头部 开始-->
<div class="top">
	<a href="<?php echo ($webpath); ?>" class="logo"></a>
    <!--搜索 开始-->
	<div class="ss">
    	<div class="ss1">
        	<div id="searchSuggestContent" class="ss1-1"></div>
        	<form id="searchForm" name="searchForm" method="post" action="<?php echo getsearchurl();;?>">
        	<p>
                <img src="<?php echo ($tplpath); ?>images/tb1.jpg" />
                <input id="wd" name="wd"  autocomplete="off"type="text" <?php echo (($keyword)?($keyword):'请输入关键字'); ?> />
            </p>
            <a href="javascript:void(0);" onclick="document.getElementById('searchForm').submit();"></a>
            </form>
        </div>
        <div class="ss2">
            <?php echo ($hotkey); ?>
        </div>
    </div>
    <!--搜索 结束-->
    <a href="./index.php?s=top10" class="ph"></a>
    <div class="top1">
    	<a href="javascript:void(0);" id="login_btn" style="display:none;">登录</a>|<a href="javascript:void(0);" id="reg_btn" style="display:none;">注册</a>
        <a href="./index.php?s=Guestbook" style="color:#F00">我要求片</a>|
        <a href="javascript:void(0);" class="top1-1" id="play_old_list_a" onblur="this.blur();">观看记录</a>
        
    	<!--观看记录 开始-->
        <div class="jilu" id="play_old_list">
        	<span class="jilu1"></span>
            <div class="jilu3" id="play_old_list_content">
                
                <div class="jilu1-3"><a href="#" class="qk">全部清空</a></div>
            </div>
            <span class="jilu2"></span>
        </div>
        <!--观看记录 结束-->
        
    </div>
</div>
<!--头部 结束-->
<!--导航 开始-->
<div class="nav">
	<div class="nav1">
		<div class="nav1-1">
            <a href="<?php echo ($webpath); ?>" <?php if($model == 'index'): ?>class="on"<?php endif; ?>>首页</a><span></span>
            
            <?php $tag['name'] = 'menu'; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><a onfocus="this.blur();" href="<?php echo ($menu["showurl"]); ?>" <?php if(($menu['id'] == $cid) or ($menu['id'] == $pid)): ?>class="on"<?php endif; ?>><?php echo ($menu["cname"]); ?></a><span></span><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
            <a href="<?php echo getspecialurl();;?>">专题</a>
            <a href="./template/default/Home/webplayer.php" target="_blank">直播</a>
		</div>
        <p class="nav1-2">
        
        <?php $tag['name'] = 'self';$tag['cid'] = '9';$tag['limit'] = '4'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): ++$i;$mod = ($i % 2 );?><a href="<?php echo ($self["link"]); ?>"target="_blank" style="color:<?php echo ($self["color"]); ?>"><?php echo ($self["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>    
            
        </p>
	</div>
</div>
<!--导航 结束-->


<div class="wapper">
    <div class="dq"><span>您现在所在的位置：</span><?php echo ($navtitle); ?></div>
    
    <div class="dq" style="height:auto;">
    <form action="<?php echo ($webpath); ?>index.php?s=Guestbook/Insert" method="post" name="guestbook" id="guestbook">
    	<table width="100%" border="0" cellpadding="5" cellspacing="1">
        	<tr><td><strong>我也说两句</strong></td>
       	    </tr>
        	<tr>
        	  <td><textarea style="width:100%;" id="content" name="content" rows="5" onfocus="if(this.value=='分享您的看法吧，最多200个字。'){this.value='';};this.select();" onblur="if(this.value==''){this.value='分享您的看法吧，最多200个字。';};" class="txt_in" maxlength="200"></textarea></td>
       	  </tr>
        	<tr>
        	  <td><button type="submit" class="sub_btn" name="submit" id="submitCommBtn" ><span>发表留言</span></button></td>
       	  </tr>
        </table>
    </form>
    </div>
    <div class="dq" style="height:auto;">
    <?php if(is_array($list_guestbook)): $i = 0; $__LIST__ = $list_guestbook;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$guestbook): ++$i;$mod = ($i % 2 )?><table width="100%" border="0" cellpadding="5" cellspacing="1">
    <tr>
      <td style="background-color:#EFEFEF"><span class="time">第 <?php echo ($guestbook["floor"]); ?> 楼<strong>的<?php echo (remove_xss(htmlspecialchars($guestbook["username"]))); ?></strong> 在 <?php echo (get_color_date('Y-m-d H:i',$guestbook["addtime"])); ?> 写道：</span></td>
    </tr>
    <tr>
      <td><?php echo (remove_xss(htmlspecialchars($guestbook["content"]))); ?></td>
    </tr>
    <tr>
      <td>站长回复：<?php echo ($guestbook["recontent"]); ?></td>
    </tr>
  </table><?php endforeach; endif; else: echo "" ;endif; ?>
    
    
    <?php if(($count)  >  "10"): ?><div class="pages"><?php echo ($pages); ?></div><?php endif; ?>
  </div>
    
    
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/system.js"></script>
<script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>
   <?php echo get_cms_ads('duilian_quanzhan');?>
   <?php echo get_cms_ads('fumeiti_quanzhan');?>
    <!--版权 开始-->
    <div class="bq">
   		<?php echo ($copyright); ?>
        <p style="height:8px;"></p>

        Copyright © 2007 - 2013 <a href="<?php echo ($weburl); ?>"><?php echo ($webname); ?></a> Some Rights Reserved <?php echo ($icp); ?> 

<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F486818640b3b4282e3d4131a8423f5b6' type='text/javascript'%3E%3C/script%3E"));
</script>


<a href="<?php echo ($baidusitemap); ?>">sitemap</a> <a href="<?php echo ($googlesitemap); ?>">sitemap</a><br />


        <span style="display:none;"><script language="javascript" type="text/javascript" src="http://js.users.51.la/15665491.js"></script></span>
    </div>
    <!--版权 结束-->

</div>
</body>
</html>