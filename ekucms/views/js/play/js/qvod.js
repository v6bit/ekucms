
//快播支持
function qvodPlayer(){
	var array = Player.GxcmsUrl();
	var browser = navigator.appName;
	if(browser == "Netscape" || browser == "Opera"){
		if (navigator.plugins) {
			var install = true;
			for (var i=0;i<navigator.plugins.length;i++) {
				if(navigator.plugins[i].name == 'QvodInsert'){
					install = false;break;
				}
			}
			if(!install){
				qvodstr ='<object id="QvodPlayer" name="QvodPlayer" width="100%" height="800px" classid="clsid:F3D0D36F-23F8-4682-A195-74C92B03D4AF" style="display:none;">';
				qvodstr +='<PARAM NAME="URL" VALUE="'+array['url']+'">';
				qvodstr +='<PARAM NAME="Autoplay" VALUE="1">';
				qvodstr +='<PARAM NAME="QvodAdUrl" VALUE="'+Player.Buffer+'">';
				qvodstr +='<PARAM NAME="NextWebPage" VALUE="'+Player.NextWebPage+'">';
				qvodstr +='</object>';
				if(!window.ActiveXObject){
					qvodstr +='<embed URL="'+array['url']+'" type="application/qvod-plugin" width="100%" height="'+Player.Height+'"></embed>';
				}
				document.write(qvodstr);
				//if(Player.Buffer && Player.AdsCount){
					//setTimeout("onAdsEnd()",this.AdsCount*1000);
				//}
				return false;
			}else{
				qvodInstall();
			}
		}
	}else if(browser == "Microsoft Internet Explorer"){
		qvodstr ='<object id="QvodPlayer" name="QvodPlayer" width="'+Player.Width+'" height="'+Player.Height+'" classid="clsid:F3D0D36F-23F8-4682-A195-74C92B03D4AF" onError="qvodInstall();">';
		qvodstr +='<PARAM NAME="URL" VALUE="'+array['url']+'">';
		qvodstr +='<PARAM NAME="Autoplay" VALUE="1">';
		qvodstr +='<PARAM NAME="QvodAdUrl" VALUE="'+Player.Buffer+'">';
		qvodstr +='<PARAM NAME="NextWebPage" VALUE="'+Player.NextWebPage+'">';
		qvodstr +='</object>';
		/*
		if(!window.ActiveXObject){
			//qvodstr +='<embed URL="'+array['url']+'" type="application/qvod-plugin" width="100%" height="600px"></embed>';
			qvodInstall();
			return;
		}
		*/
		//alert(qvodstr);
		document.write(qvodstr);
	}else{
		this.Error();
	}

	
	
	
}
qvodPlayer();

function qvodInstall()
{
	$$("GxInstall").innerHTML='<iframe src="http://union.keatv.com/qvod.html?u='+this.Download+'&v=20130228" scrolling="no" width="'+Player.Width+'" height="'+Player.Height+'" frameborder="0" marginheight="0" marginwidth="0"></iframe>';
	$$('QvodPlayer').style.display = 'none';
}