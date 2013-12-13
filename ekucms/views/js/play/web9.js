function $Showhtml(){
	url = Player.Url.replace(/\+/g,' ');
	player = '<OBJECT name="myWebPlayer9" id="myWebPlayer9" classid="clsid:947BA55B-2113-4349-8784-FFB9D7F881C9" width="100%" height="'+Player.Height+'" align="center" onError="Player.Install();">';
	player += '<param name="Mode" value="full">';
	player += '<param name="Title" value="本站由<飞飞影视系统>建设!">';
	player += '<param name="AdURL" value='+Player.Buffer+'>';
	player += '<param name="EmbedURL" value="http://www.ff84.com/?web9">';
	player += '<param name="URL" value="'+url+'">';
	player += '<param name="TextAds" value="ADNCMS官方网站|http://www.adncms.net/@PHP视频程序|http://www.ff84.com">';
	player += '<param name="NextVideoURL" value="'+Player.NextUrl+'">';
	player += '<param name="GlobalCache" value=-1>';
	player += '</OBJECT>';
	return player;
}
Player.Show();