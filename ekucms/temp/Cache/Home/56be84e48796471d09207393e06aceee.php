<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="keywords" content="<?php echo ($ckeywords); ?><?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($cdescription); ?><?php echo ($description); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>pub.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($tplpath); ?>yiku.css"/>
<script type="text/javascript" src="/ck6/ckplayer.js" charset="utf-8"></script>
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
<script>
//document.write('<?php echo ($aaa1); ?>v6player://<?php echo ($name["nexusphp"]); ?>&ty=2&ro=2&url=222.199.184.28&id=<?php echo ($name["nexusphp"]); ?>&ua=<?php echo ($passkey); ?>;');

</script>


当前位置：<?php echo ($navtitle); ?> <?php echo ($playname); ?>

    </div>
    <!--当前位置 结束-->
    
    
    <!--播放 开始-->
    <div class="bf">
        
        <div class="bf1"><?php echo ($player); ?>  

<script>
//<script language="Javascript" src="http://222.199.184.25/webplayer1.php?id=<?php echo ($name["nexusphp"]); ?>">
</script>
<script>
//select="<select  id='menu1' size='15' multiple type='hidden' onChange='doGo(this.value)'><option value='http://127.0.0.1:8889/大宋提刑官-第10集.mp4'>第10集</select>";
select="<select  style='width:200px' id='menu1' size='15' multiple type='hidden' onChange='doGo(this.value)'><?php if(is_array($aaa)): $i = 0; $__LIST__ = $aaa;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value='http://127.0.0.1:8889/<?php echo ($vo["0"]); ?>'><?php echo ($vo["0"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>";
//select="<select  id='menu1' size='15' multiple type='hidden' onChange='doGo(this.value)'><option value='<?php global $a; echo $a; ?>'>第10集</select>";
document.write(select);
//doGo('http://127.0.0.1:8889/<?php echo ($aaa1); ?>');
</script>


</div>



    </div>
    <!--播放 结束-->
	
    <!--详情 开始-->
    <div class="xq">
        <!--左边 开始-->
        <div class="left2">
        
        
            <div class="like" style="margin-top:10px;">

                <div id="tab" class="tab">
                    <?php if(is_array($ppplay)): $i = 0; $__LIST__ = $ppplay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><div id="play_name_<?php echo ($i); ?>" type="<?php echo ($video["playname"]); ?>" <?php if($i == 1): ?>class="on"<?php else: ?>class="off"<?php endif; ?> title="<?php echo ($video["playername"]); ?>" onclick="video_detail_tag_change(<?php echo ($i); ?>,10,'play_name_','play_ji_','on','off','show','hide')"><span><?php echo ($video["playername"]); ?></span></div><?php endforeach; endif; else: echo "" ;endif; ?>    

               

                </div>
                
                <?php if(is_array($ppplay)): $i = 0; $__LIST__ = $ppplay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><div id="play_ji_<?php echo ($i); ?>" <?php if($i == 1): ?>class="show"<?php else: ?>class="hide"<?php endif; ?>>
                        <div class="like1-2"><span class="on5">正序</span><span onclick="document.getElementById('play_ji_<?php echo ($i); ?>').className = 'hide';document.getElementById('play_ji_desc_<?php echo ($i); ?>').className = 'show';">倒序</span></div>
                        <!--剧集 开始-->
                        <div class="juji">
                        
                        
                        	<?php if(is_array($video['son'])): $ii = 0; $__LIST__ = $video['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ppvodson): ++$ii;$mod = ($ii % 2 )?><a href="<?php echo ($ppvodson["playurl"]); ?>" target="_blank"><?php echo ($ppvodson["playname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            
                            <div class="clear"></div>
                        </div>
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
        
        
        
        	<!--集数 开始-->
            <div class="left2-2" style="display:none;">
                    <div class="bg2">
                    
                        <p>共40集 当前更新至22集</p>
                        
                        <!--剧集 开始-->
                        <div class="juji juji1">
                            <a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><a href="#">10</a><a href="#">11</a><a href="#">12</a><a href="#">13</a><a href="#">14</a><a href="#">15</a><a href="#">16</a><a href="#">17</a><a href="#">18</a><a href="#">19</a><a href="#">20</a><a href="#">21</a><a href="#">22</a><a href="#">23<img src="images/xin.gif" /></a>
                            <div class="clear"></div>
                        </div>
                        <!--剧集 结束-->
                        
                    </div>
            </div>
            <!--集数 结束-->
            
            
            <!--广告 开始-->
            <div class="banner2"><?php echo get_cms_ads('play_700_90');?></div>
            <!--广告 结束-->
            <!--猜你喜欢 开始-->
            <div class="like like1">
                <div id="tab" class="tab">
                    <div class="on" title="猜你喜欢" onclick="change(this)"><span>猜你喜欢</span></div>
                </div>
                <!--最近更新 开始-->
                <div id="猜你喜欢" class="show">
                    <ul class="rb2-1 list1-1" id="hot_video" href="<?php echo ($webpath); ?>index.php?s=my/show/id/hot_video/cid/<?php echo ($cid); ?>/limit/5">
                    
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
            <!--评分 开始-->
            <div class="pf">
                <div class="fx1">

<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_tsina"></a>
<a class="bds_qzone"></a>
<a class="bds_renren"></a>
<a class="bds_tqq"></a>
<a class="bds_t163"></a>
<span class="bds_more">更多</span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=703427" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->


                </div>
            </div>
            <!--评分 结束-->
            <!--简介 开始-->
            <div class="right1 jianjie">
            <div class="bg">
            	<h1><span><?php echo ($title); ?></span></h1>
                <p>导演：<a href="#"><?php echo ($director); ?></a></p>
                <p>主演：<?php if(!empty($actor)): ?><?php echo (get_actor_url($actor)); ?><?php else: ?>未知<?php endif; ?></p>
                <p>上映：<?php echo ($year); ?></p>
                <p>播放：<?php echo ($hits); ?></p>
                <div class="jianjie1">
                	<span>剧情介绍：</span>
                    <p><?php echo ($content); ?></p>
                </div>
            </div>
            </div>
            <!--简介 结束-->
            <!--广告 开始-->
            <div class="banner1"><?php echo get_cms_ads('play_250_250');?></div>
            <!--广告 结束-->
        </div>
        <!--右边 结束-->
        <div class="clear"></div>
    </div>
    <!--详情 结束-->
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ($webpath); ?>views/js/system.js"></script>
<script type="text/javascript" src="<?php echo ($tplpath); ?>yiku.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var name='<?php echo ($title); ?>';
    var num='<?php echo ($playname); ?>';
	var url=window.location.href;
    CheckAdd(name,'gxhis',url,num)
	
	
	
	
	var URL = document.URL.split('.html');
	URL = URL[0].match(/\d+.*/g)[0].match(/\d+/g);
	var Count = URL.length;
	var sid = URL[(Count-1)]*1;
	var array = new Array();
	
	
		switch(url_html_play)
		{
			case 1://每集生成时的播放
				
				var URL = Player.Url.split(html_file_suffix+'?');
				URL = URL[1].split('-');
				Count = URL.length;
				
				if (Count == 2)
				{
					array['sid'] = 0;
				}else{
					array['sid'] = URL[2]*1;
				}
				

				
				
				array['id'] = URL[0]*1;
				array['pid'] = URL[1]*1;		
				break;
			case 2:
				var URL = Player.Url.split(html_file_suffix);
				URL = URL[0].split('/');
				var Count = URL.length;
				URL = URL[Count-1].split('-');
				Count = URL.length;
				
				if (Count == 2)
				{
					array['sid'] = 0;
				}else{
					array['sid'] = URL[2]*1;
				}
				array['id'] = URL[0]*1;
				array['pid'] = URL[1]*1;		
				break;
			default: //动态模式下面的加载播放器
				var URL = Player.Url.split(html_file_suffix);
				URL = URL[0].split('/');
				var Count = URL.length;
				URL = URL[Count-1].split('-');
				Count = URL.length;
				console.log(URL);
				if (Count == 2)
				{
					array['sid'] = 0;
				}else{
					array['sid'] = URL[2]*1;
				}
				array['id'] = URL[0]*1;
				array['pid'] = URL[1]*1;		
				break;
		}
	
	
	var type = playlistArr[array['sid']];
	
	video_detail_tag_change2(type,10,'play_name_','play_ji_','on','off','show','hide');
});
</script>
<?php echo ($inserthits); ?>
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

<script>
       

function init()
{
    if( navigator.appName.indexOf("Microsoft Internet")==-1 )
    {
        onVLCPluginReady()
    }
    else if( document.readyState == 'complete' )
    {
        onVLCPluginReady();
    }
    else
    {
        
        document.onreadystatechange=function()
        {
            if( document.readyState == 'complete' )
            {
                onVLCPluginReady();
            }
        }
    }
}

function getVLC(name)
{
    if (window.document[name])
    {
        return window.document[name];
    }
    if (navigator.appName.indexOf("Microsoft Internet")==-1)
    {
        if (document.embeds && document.embeds[name])
            return document.embeds[name];
    }
    else // if (navigator.appName.indexOf("Microsoft Internet")!=-1)
    {
        return document.getElementById(name);
    }
}

function registerVLCEvent(event, handler)
{
    var vlc = getVLC("vlc");

    if (vlc) {
        if (vlc.attachEvent) {
            // Microsoft
            vlc.attachEvent (event, handler);
        } else if (vlc.addEventListener) {
            // Mozilla: DOM level 2
            vlc.addEventListener (event, handler, true);
        } else {
            // DOM level 0
            eval("vlc.on" + event + " = handler");
        }
    }
}

function unregisterVLCEvent(event, handler)
{
    var vlc = getVLC("vlc");

    if (vlc) {
        if (vlc.detachEvent) {
            // Microsoft
            vlc.detachEvent (event, handler);
        } else if (vlc.removeEventListener) {
            // Mozilla: DOM level 2
            vlc.removeEventListener (event, handler, true);
        } else {
            // DOM level 0
            eval("vlc.on" + event + " = null");
        }
    }
}

// JS VLC API callbacks
function handleMediaPlayerMediaChanged()
{
    document.getElementById("info").innerHTML = "Media Changed";
}

function handle_MediaPlayerNothingSpecial()
{
    document.getElementById("state").innerHTML = "Idle...";
}

function handle_MediaPlayerOpening()
{
    onOpen();
}

function handle_MediaPlayerBuffering(val)
{
    document.getElementById("info").innerHTML = val + "%";
}

function handle_MediaPlayerPlaying()
{
    onPlay();
}

function handle_MediaPlayerPaused()
{
    onPause();
}

function handle_MediaPlayerStopped()
{
    onStop();
}

function handle_MediaPlayerForward()
{
    document.getElementById("state").innerHTML = "Forward...";
}

function handle_MediaPlayerBackward()
{
    document.getElementById("state").innerHTML = "Backward...";
}

function handle_MediaPlayerEndReached()
{
    onEnd();
}

function handle_MediaPlayerEncounteredError()
{
    onError();
}

function handle_MediaPlayerTimeChanged(time)
{
    var vlc = getVLC("vlc");
    var info = document.getElementById("info");
    if( vlc )
    {
        var mediaLen = vlc.input.length;
        if( mediaLen > 0 )
        {
            // seekable media
            info.innerHTML = formatTime(time)+"/"+formatTime(mediaLen);
        }
    }
}

function handle_MediaPlayerPositionChanged(val)
{
    // set javascript slider to correct position
}

function handle_MediaPlayerSeekableChanged(val)
{
    setSeekable(val);
}

function handle_MediaPlayerPausableChanged(val)
{
    setPauseable(val);
}

function handle_MediaPlayerTitleChanged(val)
{
    //setTitle(val);
    document.getElementById("info").innerHTML = "Title: " + val;
}

function handle_MediaPlayerLengthChanged(val)
{
    //setMediaLength(val);
}

// VLC Plugin
function onVLCPluginReady()
{
    registerVLCEvent("MediaPlayerMediaChanged", handleMediaPlayerMediaChanged);
    registerVLCEvent("MediaPlayerNothingSpecial", handle_MediaPlayerNothingSpecial);
    registerVLCEvent("MediaPlayerOpening", handle_MediaPlayerOpening);
    registerVLCEvent("MediaPlayerBuffering", handle_MediaPlayerBuffering);
    registerVLCEvent("MediaPlayerPlaying", handle_MediaPlayerPlaying);
    registerVLCEvent("MediaPlayerPaused", handle_MediaPlayerPaused);
    registerVLCEvent("MediaPlayerStopped", handle_MediaPlayerStopped);
    registerVLCEvent("MediaPlayerForward", handle_MediaPlayerForward);
    registerVLCEvent("MediaPlayerBackward", handle_MediaPlayerBackward);
    registerVLCEvent("MediaPlayerEndReached", handle_MediaPlayerEndReached);
    registerVLCEvent("MediaPlayerEncounteredError", handle_MediaPlayerEncounteredError);
    registerVLCEvent("MediaPlayerTimeChanged", handle_MediaPlayerTimeChanged);
    registerVLCEvent("MediaPlayerPositionChanged", handle_MediaPlayerPositionChanged);
    registerVLCEvent("MediaPlayerSeekableChanged", handle_MediaPlayerSeekableChanged);
    registerVLCEvent("MediaPlayerPausableChanged", handle_MediaPlayerPausableChanged);
    registerVLCEvent("MediaPlayerTitleChanged", handle_MediaPlayerTitleChanged);
    registerVLCEvent("MediaPlayerLengthChanged", handle_MediaPlayerLengthChanged);
}

function close()
{
    unregisterVLCEvent("MediaPlayerMediaChanged", handleMediaPlayerMediaChanged);
    unregisterVLCEvent("MediaPlayerNothingSpecial", handle_MediaPlayerNothingSpecial);
    unregisterVLCEvent("MediaPlayerOpening", handle_MediaPlayerOpening);
    unregisterVLCEvent("MediaPlayerBuffering", handle_MediaPlayerBuffering);
    unregisterVLCEvent("MediaPlayerPlaying", handle_MediaPlayerPlaying);
    unregisterVLCEvent("MediaPlayerPaused", handle_MediaPlayerPaused);
    unregisterVLCEvent("MediaPlayerStopped", handle_MediaPlayerStopped);
    unregisterVLCEvent("MediaPlayerForward", handle_MediaPlayerForward);
    unregisterVLCEvent("MediaPlayerBackward", handle_MediaPlayerBackward);
    unregisterVLCEvent("MediaPlayerEndReached", handle_MediaPlayerEndReached);
    unregisterVLCEvent("MediaPlayerEncounteredError", handle_MediaPlayerEncounteredError);
    unregisterVLCEvent("MediaPlayerTimeChanged", handle_MediaPlayerTimeChanged);
    unregisterVLCEvent("MediaPlayerPositionChanged", handle_MediaPlayerPositionChanged);
    unregisterVLCEvent("MediaPlayerSeekableChanged", handle_MediaPlayerSeekableChanged);
    unregisterVLCEvent("MediaPlayerPausableChanged", handle_MediaPlayerPausableChanged);
    unregisterVLCEvent("MediaPlayerTitleChanged", handle_MediaPlayerTitleChanged);
    unregisterVLCEvent("MediaPlayerLengthChanged", handle_MediaPlayerLengthChanged);
}



function doGo(targetURL)
{
    var vlc = getVLC("vlc");
  
    if( vlc )
    {
        
  
     
var options = [":vout-filter=deinterlace", ":deinterlace-mode=linear", ":sub-file=http://222.199.184.25/subs/8/8.srt"];
        var itemId = vlc.playlist.add(targetURL,"",options);
        options = [];
        if( itemId != -1 )
        {
            vlc.playlist.playItem(itemId);
        }
        else
        {
            alert("cannot play at the moment !");
        }
      
    }
}

//document.write('v6player://<?php echo ($name["id"]); ?>&ty=2&ro=2&url=222.199.184.25&id=<?php echo ($name["id"]); ?>&ua=<?php echo ($passkey); ?>');

//doGo('http://127.0.0.1:8889/大宋提刑官-第11集.mp4');
//window.location.href="<?php echo ($name["nexusphp"]); ?>";
window.location.href="v6player://<?php echo ($name["nexusphp"]); ?>&ty=2&ro=2&url=bt.6xvod.com&id=<?php echo ($name["nexusphp"]); ?>&ua=<?php echo ($passkey); ?>";
//window.location.href="v6player://8&ty=2&ro=2&url=222.199.184.25&id=8&ua=079ad0b0ac4c1f53572941bb9d18eb73";

//doGo('http://127.0.0.1:8889/大宋提刑官-第11集.mp4');
 
doGo('http://127.0.0.1:8889/<?php echo ($aaa1); ?>');



  

</script>

<!--wapper 结束-->
</body>
</html>