<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($description); ?>">
<title><?php echo ($webtitle); ?></title>
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


<!--wapper 开始-->
<div class="wapper">
	<!--列表 开始-->
    <div class="list">
   		<!--左边 开始-->
        <div class="left1">
            <!--最近更新电视剧 开始-->
            <div class="right1 left1-1">
            <div class="bg">
            	<h1><span>最近更新<?php echo ($cname); ?></span></h1>
                <!--热榜 开始-->
                <ul class="ph2">
                <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,14)); ?></a><span><?php echo (get_color_date('m-d',$video["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                </ul>
                <!--热榜 结束-->
            </div>
            </div>
            <!--最近更新电视剧 结束-->
            <!--电视剧热播榜 开始-->
            <div class="right1 left1-1">
            <div class="bg">
            	<h1><span><?php echo ($cname); ?>热播榜</span></h1>
                <!--热榜 开始-->
                <ul class="ph2">
                <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '10';$tag['order'] = 'addtime desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?>><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank" title="<?php echo ($video["title"]); ?>"><?php echo (get_replace_html($video["title"],0,14)); ?></a><span><?php echo ($video["hits"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                </ul>
                <!--热榜 结束-->
            </div>
            </div>
            <!--电视剧热播榜 结束-->
            <!--广告 开始-->
            <div class="banner1">
            <?php echo get_cms_ads('list_250_250');?>
            </div>
            <!--广告 结束-->
        </div>
        <!--左边 结束-->
        <!--右边 开始-->
        <div class="right2">
            <div class="right2-1">
            	<span class="h1"><?php echo ($cname); ?></span><img src="<?php echo ($tplpath); ?>images/xian1.jpg" />
                <!--检索条件 开始-->
                <div class="right2-2">
                </div>
                <!--检索条件 结束-->
                <p>共有 <font style="color:#ff4e00;"><?php echo ($count); ?></font> 个符合条件的内容</p>
            </div>
            <!--选择 开始-->
            <div class="xz">
            
            
            <?php if($stypetagcount > 0): ?><div class="xz1">
                	<span>标签：</span>
                    <p><a href="<?php echo getstypetaglink($cid,0);?>" <?php if(($m_cid == 0)): ?>class="on3"<?php endif; ?>>全部</a>
                    <?php if(is_array($stypetag)): $i = 0; $__LIST__ = $stypetag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><a href="<?php echo getstypetaglink($cid,$item['m_cid']);?>" <?php if(($m_cid == $item['m_cid'])): ?>class="on3"<?php endif; ?>><?php echo ($item["m_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                    
                    
                    </p>
                    <div class="clear"></div>
                </div><?php endif; ?>  
              
                <?php if($pcount == false): ?><div class="xz1">
                        <span>类型：</span>
                        <p><a href="<?php echo gettypelink($pid);?>" class="on3">全部</a>
                        <?php $tag['name'] = 'menu';$tag['ids'] = ''.$cid.''; $__LIST__ = get_tag_gxmenu($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): ++$i;$mod = ($i % 2 );?><?php if(is_array($menu["son"])): $i = 0; $__LIST__ = $menu["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuson): ++$i;$mod = ($i % 2 )?><a href="<?php echo gettypelink($menuson['id']);?>"><?php echo ($menuson["cname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>
                        </p>
                        <div class="clear"></div>
                    </div><?php endif; ?>
                
                
                <div class="xz1">
                	<span>地区：</span>
                    <p>
                    <?php echo getarealist('on3',$cid);?>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="xz1">
                	<span>时间：</span>
                        <p>
                        <?php echo getyearlistnew('on3',9,$cid);?>
                        </p>
                    <div class="clear"></div>
                </div>
                <div class="xz1">
                	<span>字母：</span>
                    <p>
                    <a href="<?php echo getwbfurl($cid,2);?>" <?php if(($letter == '')): ?>class="on3"<?php endif; ?>>全部</a>
                    <?php echo get_letter_url($cid,$letter,'video','on3');?></p>
                    <div class="clear"></div>
                </div>
            </div>
            <!--选择 结束-->
            
            <!--列表 开始-->
            <div id="tab" class="list1">
            	<div <?php if($order == 'addtime'): ?>class="on"<?php else: ?>class="off"<?php endif; ?>  title="最近更新" onclick="window.location='<?php echo getlistorderurl('addtime');?>'"><span>最近更新<?php echo ($order); ?></span></div>
                <div <?php if($order == 'weekhits'): ?>class="on"<?php else: ?>class="off"<?php endif; ?> title="最高人气" onclick="window.location='<?php echo getlistorderurl('weekhits');?>'"><span>最高人气</span></div>
            	<div <?php if($order == 'score'): ?>class="on"<?php else: ?>class="off"<?php endif; ?> title="最受好评" onclick="window.location='<?php echo getlistorderurl('score');?>'"><span>最受好评</span></div>
            </div>
            
            <!--最近更新 开始-->
            <div id="最近更新($cid)" class="show">
                <ul class="rb2-1 list1-1">
                <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '15';$tag['order'] = ''.$order.''; $__LIST__ = get_tag_gxlist($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li>
                        <a href="<?php echo ($video["readurl"]); ?>" class="img" target="_blank"><span><?php if($video["serial"] > 0): ?>更新至<?php echo ($video["serial"]); ?><?php else: ?>完结<?php endif; ?></span><i></i><img onerror="this.src='<?php echo ($webpath); ?>views/images/nophoto.jpg'" src="<?php echo ($video["picurl"]); ?>" alt="<?php echo ($video["title"]); ?>"/></a>
                        <a href="<?php echo ($video["readurl"]); ?>" class="title" target="_blank"><?php echo ($video["title"]); ?></a>
                        <p class="title1"><?php echo (get_actor_url(get_replace_html($video["actor"],0,10))); ?></p>
                    </li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                    
                    
                </ul>
                <div class="clear">&nbsp;</div>
                <!----分页 开始---->
                <?php if(($count)  >  "10"): ?><div class="pag"><?php echo ($pages); ?></div><?php endif; ?>
                <!----分页 结束---->
            </div>
            <!--最近更新 结束-->
            
            <!--列表 结束-->
        </div>
        <!--右边 结束-->
    </div>
    <!--列表 结束-->
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
<!--wapper 结束-->
</body>
</html>