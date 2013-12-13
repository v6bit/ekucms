<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($ckeywords); ?><?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($cdescription); ?><?php echo ($description); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>
<script language="javascript">var SitePath='<?php echo ($webpath); ?>';var SiteMid='<?php echo ($mid); ?>';var SiteCid='<?php echo ($cid); ?>';var SiteId='<?php echo ($id); ?>';</script>
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
	<!--当前位置 开始-->
    <div class="dq">
        当前位置：<?php echo ($navtitle); ?>
    </div>
    <!--当前位置 结束-->
	<!--详情 开始-->
    <div class="xq">
        <!--左边 开始-->
        <div class="left2">
            <!--电视简介 开始-->
            <div class="left2-1">
                <div class="ds">
                	<span class="img1"><img onerror="this.src='<?php echo ($webpath); ?>views/images/nophoto.jpg'" src="<?php echo ($picurl); ?>" /></span>
                    <div class="ds1">
                    
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<span class="bds_more">更多</span>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=703427" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->                    
                    
                    
                    </div>
                    <span class="tishi">分享影片后，播放时会加速哦!</span>
                </div>
                
                <div class="ds2">
                	<h1><?php echo ($title); ?> <span style="font-size:12px; color:#F30"><?php if($serial > 0): ?>更新至<?php echo ($serial); ?><?php else: ?>完结<?php endif; ?></span></h1>
                    <div class="ds2-1">
                    	<span>导演：</span>
                        <p><?php if(!empty($director)): ?><?php echo ($director); ?><?php else: ?>未知<?php endif; ?></p>
                        <div class="clear"></div>
                    </div>
                    <div class="ds2-1">
                    	<span>主演：</span>
                        <p><?php if(!empty($actor)): ?><?php echo (get_actor_url($actor)); ?><?php else: ?>未知<?php endif; ?></p>
                        <div class="clear"></div>
                    </div>
                    <div class="ds2-1">
                    	<span>类型：</span>
                        <p><a href="<?php echo ($showurl); ?>"><?php echo ($cname); ?></a> <?php echo (eku_stype_url($stype_mcid,$cid)); ?></span></p>
                        <div class="clear"></div>
                    </div>
                    <div class="ds2-1">
                    	<span>年代：</span>
                        <p><?php echo (($year)?($year):'未录入'); ?></p>
                        <div class="clear"></div>
                    </div>
                    <div class="ds2-1">
                    	<span>评分：</span>
                        <p id="Scores" alttext="<?php echo ($score); ?>" title="我也来评分">加载中...
                        </p>
                        <div class="clear"></div>
                    </div>
                    
                </div>
                <div class="clear"></div>
            </div>
            <!--电视简介 结束-->
            
            
            
            <div class="like">

                <div id="tab" class="tab">

                    <?php if(is_array($ppplay)): $i = 0; $__LIST__ = $ppplay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><!--页面播放注销>
                 <!--  <div id="play_name_<?php echo ($i); ?>" <?php if($i == 1): ?>class="on"<?php else: ?>class="off"<?php endif; ?> title="<?php echo ($video["playername"]); ?>" onclick="video_detail_tag_change(<?php echo ($i); ?>,10,'play_name_','play_ji_','on','off','show','hide')"><span><?php echo ($video["playername"]); ?></span></div> --> 

<div id="play_name_2" class="on" onclick='window.location.href="v6player://<?php echo ($name["nexusphp"]); ?>&ty=1&ro=2&url=222.199.184.40/nexusphp&id=<?php echo ($name["nexusphp"]); ?>&ua=<?php echo ($passkey); ?>";'><span>客户端播放</span></div><?php endforeach; endif; else: echo "" ;endif; ?>    







                </div>
                
                <?php if(is_array($ppplay)): $i = 0; $__LIST__ = $ppplay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><div id="play_ji_<?php echo ($i); ?>" <?php if($i == 1): ?>class="show"<?php else: ?>class="hide"<?php endif; ?>>
                     <!--   <div class="like1-2"><span class="on5">正序</span><span onclick="document.getElementById('play_ji_<?php echo ($i); ?>').className = 'hide';document.getElementById('play_ji_desc_<?php echo ($i); ?>').className = 'show';">倒序</span></div> -->

<div class="like1-2"><span class="on5" onclick='window.location.href="v6player://<?php echo ($name["nexusphp"]); ?>&ty=1&ro=2&url=222.199.184.40/nexusphp&id=<?php echo ($name["nexusphp"]); ?>&ua=<?php echo ($passkey); ?>";'>点击播放</span></div>
                        <!--剧集 开始-->
                 <!--       <div class="juji">
                        	<?php if(is_array($video['son'])): $ii = 0; $__LIST__ = $video['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvodson): ++$ii;$mod = ($ii % 2 )?><a href="<?php echo ($ppvodson["playurl"]); ?>" target="_blank"><?php echo ($ppvodson["playname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="clear"></div>
                        </div>  -->

                        <!--剧集 结束-->
                        <div class="clear">&nbsp;</div>
                    </div>
                    
                    <div id="play_ji_desc_<?php echo ($i); ?>" class="hide">
                        <div class="like1-2"><span onclick="document.getElementById('play_ji_<?php echo ($i); ?>').className = 'show';document.getElementById('play_ji_desc_<?php echo ($i); ?>').className = 'hide';">正序</span><span class="on5">倒序</span></div>
                        <!--剧集 开始-->
                        <div class="juji">
                        	<?php if(is_array($video['sondesc'])): $ii = 0; $__LIST__ = $video['sondesc'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvodson): ++$ii;$mod = ($ii % 2 )?><a href="<?php echo ($ppvodson["playurl"]); ?>" target="_blank"><?php echo ($ppvodson["playname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="clear"></div>
                        </div>
                        <!--剧集 结束-->
                        <div class="clear">&nbsp;</div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?> 
                
                
                
            </div>            
            
            <div class="like">
                <div id="tab" class="tab">
                    <div class="on" title="剧情介绍" onclick="change(this)"><span>剧情介绍</span></div>
                </div>
                
                <div>	
                	<p style="padding:10px; line-height:24px;max-height:200px; overflow-y:auto; height:auto !important;">
                    	<?php echo (htmlspecialchars_decode($content)); ?>
                    </p>
                </div>
            </div>
            
            
            
            
            
     
                
                
            
            
            <!--猜你喜欢 开始-->
            <div class="like">
                <div id="tab" class="tab">
                    <div class="on" title="猜你喜欢" onclick="change(this)"><span>猜你喜欢</span></div>
                </div>
                <!--最近更新 开始-->
                <div id="猜你喜欢" class="show">
                    <ul class="rb2-1 list1-1" id="hot_video" href="<?php echo ($webpath); ?>index.php?s=my/show/id/hot_video/cid/<?php echo ($cid); ?>/limit/5">
                    Loading...
                    </ul>
                    <div class="clear" style="height:15px;">&nbsp;</div>
                </div>
                <!--最近更新 结束-->
            </div>
            <!--猜你喜欢 结束-->
            <!--评论 开始-->
            <div class="pl" id="Comments">
            
            </div>
            <!--评论 结束-->
        </div>
        <!--左边 结束-->
        <!--右边 开始-->
        <div class="right3">
            <!--电视剧热播榜 开始-->
            <div class="right1 left1-1">
            <div class="bg">
            	<h1><span><?php echo ($cname); ?>热播榜</span></h1>
                <!--热榜 开始-->
                <ul class="ph2">
                <?php $tag['name'] = 'video';$tag['cid'] = ''.$cid.'';$tag['limit'] = '10';$tag['order'] = 'hits desc'; $__LIST__ = get_tag_gxcms($tag); if(is_array($__LIST__)): $i = 0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 );?><li><span <?php if($i < 4): ?>class="ph1-1"<?php else: ?>class="ph1-2"<?php endif; ?> ><?php echo ($i); ?></span><a href="<?php echo ($video["readurl"]); ?>" target="_blank"><?php echo ($video["title"]); ?></a><span><?php echo ($video["hits"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif;unset($__LIST__);unset($tag);?>   
                    
                </ul>
                <!--热榜 结束-->
            </div>
            </div>
            <!--电视剧热播榜 结束-->
            <!--广告 开始-->
            <div class="banner1"><?php echo get_cms_ads('video_info_right_250_250');?></div>
            <!--广告 结束-->
            <!--广告 开始-->
            <div class="banner1"><?php echo get_cms_ads('video_info_right_250_250_2');?></div>
            <!--广告 结束-->
        </div>
        <!--右边 结束-->
        <div class="clear"></div>
    </div>
    <!--详情 结束-->
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