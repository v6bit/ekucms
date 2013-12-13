function sinaPlayer(){
	var array = Player.GxcmsUrl();
	player = '<embed allowfullscreen="true" src="http://vhead.blog.sina.com.cn/player/bn_topic.swf?vid='+array['url']+'&clip_id=&imgurl=&auto=1&vblog=1&type=0&tabad=1" quality="high" bgcolor="#000" width="'+Player.Width+'" height="'+Player.Height+'" type="application/x-shockwave-flash" allowFullScreen="true" allownetworking="internal" allowscriptaccess="never" wmode="opaque" type="application/x-shockwave-flash">';
	//player = '<embed flashvars="container=main_flash&amp;playerWidth=950&amp;playerHeight=480&amp;pid=1000&amp;tid=1&amp;autoLoad=1&amp;autoPlay=1&amp;as=1&amp;tj=0&amp;tjAD=0&amp;casualPlay=1&amp;logo=1&amp;vid="'+array['url']+'"&amp;vname=初雪&amp;movietvid=cx&amp;programId=2711&amp;episode=&amp;sid=61261745&amp;next_url=&amp;mp4Id=45503288&amp;actlogActive=0&amp;HTML5Player_skin=black&amp;realfull=1&amp;moz=1&quot;/" allowfullscreen="true" src="http://p.you.video.sina.com.cn/swf/tvPlayer20130418_V4_2_39_57.swf?d=Sat Apr 20 2013 05:59:39 GMT+0800" quality="high" bgcolor="#000" width="'+Player.Width+'" height="'+Player.Height+'" type="application/x-shockwave-flash" allowFullScreen="true" allownetworking="internal" allowscriptaccess="never" wmode="opaque" type="application/x-shockwave-flash">';
	
	//
	document.write(player);
}
sinaPlayer();
// http://p.you.video.sina.com.cn/swf/tvPlayer20130418_V4_2_39_57.swf?d=Sat Apr 20 2013 05:59:39 GMT+0800