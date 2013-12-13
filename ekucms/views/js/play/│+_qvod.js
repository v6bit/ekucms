function $Showhtml(){
	Player.Url = $Qvodurl(Player.Url,Player.UrlName);
	Player.NextUrl = $Qvodurl(Player.NextUrl,Player.UrlNextName);
	player ='<object id="QvodPlayer" name="QvodPlayer" width="100%" height="'+Player.Height+'" classid="clsid:F3D0D36F-23F8-4682-A195-74C92B03D4AF" onError="Player.Install();" style="display:none;">';
	player +='<PARAM NAME="URL" VALUE="'+Player.Url+'">';
	player +='<PARAM NAME="Autoplay" VALUE="1">';
	player +='<PARAM NAME="QvodAdUrl" VALUE="'+Player.Buffer+'">';
	player +='<PARAM NAME="NextWebPage" VALUE="'+Player.NextWebPage+'">';
	player +='</object>';
	if(!window.ActiveXObject){
		player +='<embed URL="'+Player.Url+'" type="application/qvod-plugin" width="100%" height="'+Player.Height+'"></embed>';
	}	
	return player;
}
function $QvodStatus(){
	if(QvodPlayer.Full == 0){
		if(QvodPlayer.PlayState == 3){
			$('buffer').style.display = 'none';
			QvodPlayer.style.height = Player.Height;
		}else{
			$('buffer').style.display = 'block';
			$('buffer').style.height = Player.Height-60;
			QvodPlayer.style.height = 60;
		}
	}	
}
function $QvodNextDown(){
	if(QvodPlayer.get_CurTaskProcess() > 900 && !bstartnextplay){
		QvodPlayer.StartNextDown(Player.NextUrl);
		bstartnextplay = true;
	}
}
function $Qvodurl(url,urlname){
	var qvodname = parent.vod_name.replace(/\//g,"")+urlname;
	if(url.indexOf("vod://")>0){
		url = url.split("|");
		qvodurl = url[0]+"|"+url[1]+"|[www.ff84.com]"+qvodname+".rmvb|";
		return qvodurl;
	}
	return url;
}
Player.Show();
if(QvodPlayer.URL != undefined){
	QvodPlayer.style.display = 'block';
	setInterval("$QvodStatus()",500);
	if(Player.NextWebPage){
		var bstartnextplay = false;
		setInterval("$QvodNextDown()",9333);
	}
}