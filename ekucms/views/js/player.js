/**
 * @name bdplayer 1.0.22.39(beta7) 
 * @time 2011-08-12
*/
var $$ = function(value){
	return document.getElementById(value);
}
var Player = {
	'Url': document.URL,
	'Width': player_width,
	'Height': player_height,
	'Buffer': player_buffer,
	'AdsCount': player_time,
	'Download': player_down,
	'NextWebPage':'',
	'Urllist': $playlist.split('+++'),
	'Install': function() {$$("GxInstall").innerHTML='<iframe src="http://player.baidu.com/lib/setupax/brxbdyy.html?u='+this.Download+'&v=20130305" scrolling="no" width="'+this.Width+'" height="'+this.Height+'" frameborder="0" marginheight="0" marginwidth="0"></iframe>';
	},
	'Navigate': function() {
		var array = this.GxcmsUrl();
		var sid = array['sid'];

		return;
		if (navigator.plugins) {
			var install = true;
			for (var i=0;i<navigator.plugins.length;i++) {
				if(navigator.plugins[i].name == 'BaiduPlayer Browser Plugin'){
					install = false;break;
				}
			}
			if(!install){
				$$("GxPlayer").innerHTML = '<div style="width:'+this.Width+'px;height:'+this.Height+'px;overflow:hidden;position:relative"><iframe src="'+this.Buffer+'" scrolling="no" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" name="Gxbuffer" id="Gxbuffer" style="display:none;position:absolute;z-index:2;top:0px;left:0px"></iframe><object id="BaiduPlayer" name="BaiduPlayer" type="application/player-activex" width="'+this.Width+'" height="'+this.Height+'" progid="Xbdyy.PlayCtrl.1" param_URL="'+array["url"]+'"param_NextCacheUrl="'+array["nextcacheurl"]+'" param_LastWebPage="'+array["lastwebpage"]+'" param_NextWebPage="'+array["nextwebpage"]+'" param_OnPlay="onPlay" param_OnPause="onPause" param_OnFirstBufferingStart="onFirstBufferingStart" param_OnFirstBufferingEnd="onFirstBufferingEnd" param_OnPlayBufferingStart="onPlayBufferingStart" param_OnPlayBufferingEnd="onPlayBufferingEnd" param_OnComplete="onComplete" param_Autoplay="1"></object></div>';
				if(this.Buffer && this.AdsCount){
					setTimeout("onAdsEnd()",this.AdsCount*1000);
				}
				return false;
			}
		}
		this.Install();
	},
	'Msie': function() {
		var array = this.GxcmsUrl();
		var sid = array['sid'];
		/*switch(sid)
		{
			case 0:
				//alert('baidu');
				var _script = document.createElement("script");
			     _script.type = "text/javascript";
				 _script.src = "/views/js/play/bdhd.js";
				 document.getElementsByTagName("head")[0].appendChild(_script); 
				break;
			case 1:
				var _script = document.createElement("script");
			     _script.type = "text/javascript";
				 _script.src = "/views/js/play/qvod.js";
				 document.getElementsByTagName("head")[0].appendChild(_script); 
				break;
			case 2:
				//alert('sohu');
				document.write('<script src="/views/js/play/sohu.js"></script>');
				break;
			case 3:
				//alert('tudou');
				document.write('<script src="/views/js/play/tudou.js"></script>');
				break;
			case 4:
				//alert('youku');
				document.write('<script src="/views/js/play/yuku.js"></script>');
				break;
			case 5:
				//alert('qiyi');
				document.write('<script src="/views/js/play/qiyi.js"></script>');
				break;
			case 6:
				//alert('letv');
				document.write('<script src="/views/js/play/letv.js"></script>');
				break;
			case 7:
				var _script = document.createElement("script");
			     _script.type = "text/javascript";
				 _script.src = "/views/js/play/ckplayer.js";
				 document.getElementsByTagName("head")[0].appendChild(_script); 
				break;
		}*/
		return;
		
		
		
		var html;
		html ='<iframe src="'+this.Buffer+'" scrolling="no" width="'+this.Width+'" height="'+this.Height+'" frameborder="0" marginheight="0" marginwidth="0" id="Gxbuffer" style="display:none;position:absolute;z-index:9;"></iframe><object classid="clsid:02E2D748-67F8-48B4-8AB4-0A085374BB99" width="'+this.Width+'" height="'+this.Height+'" id="BaiduPlayer" name="BaiduPlayer" onerror="Player.Install();" style="display:none"><param name="URL" value="'+array["url"]+'"/><param name="NextCacheUrl" value="'+array["nextcacheurl"]+'"><param name="LastWebPage" value="'+array["lastwebpage"]+'"><param name="NextWebPage" value="'+array["nextwebpage"]+'"><param name="OnPlay" value="onPlay"/><param name="OnPause" value="onPause"/><param name="OnFirstBufferingStart" value="onFirstBufferingStart"/><param name="OnFirstBufferingEnd" value="onFirstBufferingEnd"/><param name="OnPlayBufferingStart" value="onPlayBufferingStart"/><param name="OnPlayBufferingEnd" value="onPlayBufferingEnd"/><param name="OnComplete" value="onComplete"/><param name="Autoplay" value="1"/></object>';
		$$("GxPlayer").innerHTML = html;
		if(BaiduPlayer.URL != undefined){
			BaiduPlayer.style.display = 'block';
		}
		if(this.Buffer){
			try{
				var version = Number(BaiduPlayer.GetVersion().replace(/\./g,''));
				if(this.AdsCount){
					setTimeout("onAdsEnd()",this.AdsCount*1000);
				}
			}catch(e){
			}
		}
	},
	'GxcmsUrl': function() {
		var array = new Array();
		array['lastwebpage'] = '';
		array['nextwebpage'] = '';
		array['nextcacheurl'] = '';
		//得到影片ID与集数ID
		var URL = Player.Url.match(/\d+.*/g)[0].match(/\d+/g);
		var Count = URL.length;
		array['id'] = URL[(Count-3)];
		array['pid'] = URL[(Count-2)]*1;
		array['sid'] = URL[(Count-1)]*1;
		
		var url_html_play_str = html_file_suffix;
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
		//得到当前播放地址与影片集数名称
		var UrlList = Player.Urllist;
		var UrlCount = UrlList.length;
		
		if (url_html_play == 1)
		{
			var str = '$playlist'+array['sid'];
			var list  = eval(str).split('+++');
			array['url'] = Player.Bdhdurl(list[array['pid']-1]);
		}else{
			array['url'] = Player.Bdhdurl(UrlList[array['pid']-1]);
		}				
		//生成上一集与下一集播放链接
		
		if(UrlCount > 1){
			if(array['pid'] != 1){
				array['lastwebpage'] = Player.Url.replace(array['id']+'-'+array['pid'],array['id']+'-'+(array['pid']-1));
			}	
			if(array['pid'] != UrlCount){
				array['nextwebpage'] = Player.Url.replace(array['id']+'-'+array['pid'],array['id']+'-'+(array['pid']+1));
				array['nextcacheurl'] = Player.Bdhdurl(UrlList[array['pid']]);
			}
		}
		Player.NextWebPage = array['nextwebpage'];
		
		
		//alert(array['nextcacheurl']);
		return array;
	},
	'Bdhdurl': function(url) {
		if(url.indexOf("$") > 0){
			url = url.split('$')[1];
		}
		return url;
	},
	
	'Show':function(){
	
	},
	'Xbdyy' : function() {
		var browser = navigator.appName;
		if(browser == "Netscape" || browser == "Opera"){
			this.Navigate();
		}else if(browser == "Microsoft Internet Explorer"){
			this.Msie();
		}else{
			this.Error();
		}
	},
	'Error' : function() {
		alert('请使用IE内核浏览器观看本站影片!');
	}
}

var Myarray = Player.GxcmsUrl();
var Mysid = Myarray['sid'];
switch(Mysid)
{
	case 0:
		document.write('<script src="./views/js/play/bdhd.js"></script>');
		break;
	case 1:
		document.write('<script src="./views/js/play/qvod.js"></script>');
		break;
	case 2:
		document.write('<script src="./views/js/play/sohu.js"></script>');
		break;
	case 3:
		document.write('<script src="./views/js/play/tudou.js"></script>');
		break;
	case 4:
		document.write('<script src="./views/js/play/yuku.js"></script>');
		break;
	case 5:
		document.write('<script src="./views/js/play/qiyi.js"></script>');
		break;
	case 6:
		document.write('<script src="./views/js/play/letv.js"></script>');
		break;
	case 7:
		document.write('<script src="./views/js/play/ckplayer.js"></script>');
		break;
	case 8:
		document.write('<script src="./views/js/play/sinahd.js"></script>');
		break;
        case 9:
		document.write('<script src="./views/js/play/vlc.js"></script>');
		break;
}

/*
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
		//$$("Gxbuffer").src = Player.Buffer+'#pause';
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
*/
Player.Xbdyy();
