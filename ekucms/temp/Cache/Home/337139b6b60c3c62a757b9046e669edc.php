<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($ckeywords); ?><?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($cdescription); ?><?php echo ($description); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>
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


	<!--列表 开始-->
     <div class="special">
    	<h1><span>专题列表</span></h1>
        <ul class="sp-1">
        <?php $tag['name'] = 'special';$tag['limit'] = '30';$tag['order'] = 'addtime'; $__LIST__ = get_tag_gxlist($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$special): ++$i;$mod = ($i % 2 );?><li>
            	<a href="<?php echo ($special["readurl"]); ?>" target="_blank" class="img"><span><?php echo ($special["title"]); ?></span><i></i><img src="<?php echo ($special["logo"]); ?>" /></a>
            </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
          
        </ul>
    </div>




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