function letvPlayer(){
	var array = Player.GxcmsUrl();
	letvStr ='<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="100%" height="'+Player.Height+'" >';
	letvStr += '<param name="movie" value="http://www.letv.com/player/x'+array['url']+'.swf">';
	letvStr += '<param name="quality" value="High">';
	letvStr += '<embed src="http://www.letv.com/player/x'+array['url']+'.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" quality="High" width="100%" height="'+Player.Height+'"></object>';	
	document.write(letvStr);
}
letvPlayer();