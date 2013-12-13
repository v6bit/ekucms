function sohuPlayer(){
	var array = Player.GxcmsUrl();
	player = '<embed type="application/x-shockwave-flash" src="http://tv.sohu.com/upload/swf/20101021/Main.swf?autoplay=true&vid='+array['url']+'" width="'+Player.Width+'" height="'+Player.Height+'" type="application/x-shockwave-flash" allowFullScreen="true" allownetworking="internal" allowscriptaccess="never" wmode="opaque">';
	document.write(player);
}

sohuPlayer();

/*
if(Player.Second){
	$('buffer').style.position = 'absolute';
	$('buffer').style.height = Player.Height-40;
	$("buffer").style.display = "block";
	setTimeout("Player.BufferHide();",Player.Second*1000);
}
*/
