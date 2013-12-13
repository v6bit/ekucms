function $Showhtml(){
	player ='<embed src="http://player.pptv.com/v/'+Player.Url+'.swf" quality="high" width="100%" height="'+Player.Height+'" align="middle" allowScriptAccess="always" allownetworking="all" type="application/x-shockwave-flash" wmode="window" allowFullScreen="true" play="true"></embed>';
	//player ='<embed src="http://play.ppvod.cn/OpenUI.swf" quality="high" bgcolor="#000000" flashvars="url='+Player.Url+'&mode=direct|ppva&coded=true" width="100%" height="'+Player.Height+'" name="OpenPlayer" align="middle" play="true" loop="false" wmode="window" quality="high" allowscriptaccess="sameDomain" allowfullscreen="true" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"></embed>';
	return player;
}
Player.Show();
if(Player.Second){
	$('buffer').style.position = 'absolute';
	$('buffer').style.height = Player.Height-28;
	$("buffer").style.display = "block";
	setTimeout("Player.BufferHide();",Player.Second*1000);
}