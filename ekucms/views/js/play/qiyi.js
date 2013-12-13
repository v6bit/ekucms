//qiyi支持
function qiyiPlayer(){
	var array = Player.GxcmsUrl();
	qiyiStr ='<OBJECT id=flvplayer1 classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="100%" height="'+Player.Height+'" align="middle">';
	qiyiStr +='<PARAM NAME="Movie" VALUE="http://www.qiyi.com/player/20110218183154/qiyi_player.swf">';
	qiyiStr +='<param name="allowFullScreen" value="true" />';
	qiyiStr +='<param name="wmode" value="transparent" />';
	qiyiStr +='<param name="AllowScriptAccess" value="always" />';
	qiyiStr +='<param name="quality" value="high" />';
	qiyiStr +='<PARAM NAME="FlashVars" VALUE="flag=0&vid='+array['url']+'">';
	qiyiStr +='<embed allowfullscreen="true" wmode="transparent" quality="high" src="http://www.qiyi.com/player/20110218183154/qiyi_player.swf?flag=1&vid='+array['url']+'" quality="high" bgcolor="#000" width="100%" height="'+Player.Height+'" name="player" id="playerr" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">';
	qiyiStr +='</object>';
	document.write(qiyiStr);
}
qiyiPlayer();