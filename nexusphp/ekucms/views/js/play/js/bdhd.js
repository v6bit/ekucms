//百度影音支持
function baiduPlayer(){
	var array = Player.GxcmsUrl();
	var browser = navigator.appName;
	if(browser == "Netscape" || browser == "Opera"){
		if (navigator.plugins) {
			var install = true;
			for (var i=0;i<navigator.plugins.length;i++) {
				if(navigator.plugins[i].name == 'BaiduPlayer Browser Plugin'){
					install = false;break;
				}
			}
			if(!install){
				$$("GxPlayer").innerHTML = '<div style="width:'+Player.Width+'px;height:'+Player.Height+'px;overflow:hidden;position:relative"><iframe src="'+Player.Buffer+'" scrolling="no" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" name="Gxbuffer" id="Gxbuffer" style="display:none;position:absolute;z-index:2;top:0px;left:0px"></iframe><object id="BaiduPlayers" name="BaiduPlayers" type="application/player-activex" width="'+Player.Width+'" height="'+Player.Height+'" progid="Xbdyy.PlayCtrl.1" param_URL="'+array["url"]+'" param_NextCacheUrl="'+array["nextcacheurl"]+'" param_LastWebPage="'+array["lastwebpage"]+'" param_NextWebPage="'+array["nextwebpage"]+'" param_OnPlay="onPlay" param_OnPause="onPause" param_OnFirstBufferingStart="onFirstBufferingStart" param_OnFirstBufferingEnd="onFirstBufferingEnd" param_OnPlayBufferingStart="onPlayBufferingStart" param_OnPlayBufferingEnd="onPlayBufferingEnd" param_OnComplete="onComplete" param_Autoplay="1"></object></div>';
				//if(Player.Buffer && Player.AdsCount){
					//setTimeout("onAdsEnd()",this.AdsCount*1000);
				//}
				return false;
			}else{
				baiduInstall();
			}
		}
	}else if(browser == "Microsoft Internet Explorer"){
		baiduStr ='<iframe src="'+Player.Buffer+'" scrolling="no" width="'+Player.Width+'" height="'+(Player.Height-45)+'" frameborder="0" marginheight="0" marginwidth="0" id="Gxbuffer" style="display:none;position:absolute;z-index:999;"></iframe><object classid="clsid:02E2D748-67F8-48B4-8AB4-0A085374BB99" width="'+Player.Width+'" height="'+Player.Height+'" id="BaiduPlayers" name="BaiduPlayers" onerror="baiduInstall();"><param name="URL" value="'+array["url"]+'"/><param name="NextCacheUrl" value="'+Player.NextCacheUrl+'"><param name="LastWebPage" value="'+Player.LastWebPage+'"><param name="NextWebPage" value="'+Player.NextWebPage+'"><param name="OnPlay" value="onPlay"/><param name="OnPause" value="onPause"/><param name="OnFirstBufferingStart" value="onFirstBufferingStart"/><param name="OnFirstBufferingEnd" value="onFirstBufferingEnd"/><param name="OnPlayBufferingStart" value="onPlayBufferingStart"/><param name="OnPlayBufferingEnd" value="onPlayBufferingEnd"/><param name="OnComplete" value="onComplete"/><param name="Autoplay" value="1"/><param name="ShowStartClient" value="'+Player.ShowStartClient+'"/></object>';
		document.write(baiduStr);
	}else{
		this.Error();
	}
	
}
baiduPlayer();

function baiduInstall()
{
	$$("GxInstall").innerHTML='<iframe src="http://union.keatv.com/baidu.html?u='+this.Download+'&v=20130228" scrolling="no" width="'+Player.Width+'" height="'+Player.Height+'" frameborder="0" marginheight="0" marginwidth="0"></iframe>';
	$$('BaiduPlayers').style.display = 'none';
}

//beta7版播放器回调函数
var onPlay = function(){
	if(Player.Buffer){
		$$("Gxbuffer").height = Player.Height-65;
		//$$("Gxbuffer").src = Player.Buffer;	
		$$("Gxbuffer").style.display = 'none';
		//强制缓冲广告倒计时
		if(Player.AdsCount && BaiduPlayer.IsPlaying()){
			BaiduPlayer.Play();
			$$("Gxbuffer").style.display = 'block';
		}
	}
}
var onPause = function(){
	if(Player.Buffer){
		$$("Gxbuffer").src = Player.Buffer+'#pause';
		$$("Gxbuffer").style.display = 'block';
	}
}
var onFirstBufferingStart = function(){
	if(Player.Buffer){
		$$("Gxbuffer").height = Player.Height-80;
		$$("Gxbuffer").style.display = 'block';
	}
}
var onFirstBufferingEnd = function(){
	if(Player.Buffer){
		$$("Gxbuffer").style.display = 'none';
	}
}
var onPlayBufferingStart = function(){
	if(Player.Buffer){
		$$("Gxbuffer").height = Player.Height-80;
		$$("Gxbuffer").style.display = 'block';
	}
}
var onPlayBufferingEnd = function(){
	if(Player.Buffer){
		$$("Gxbuffer").style.display = 'none';
	}
}
var onComplete = function(){
	//播放完毕
}
var onAdsEnd = function(){
	//固定缓冲广告时间播放完毕
	Player.AdsCount = 0;
	if(BaiduPlayer.IsPause()){
		$$("Gxbuffer").style.display = 'none';
		BaiduPlayer.Play();
	}
}
