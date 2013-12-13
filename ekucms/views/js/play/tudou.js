//土豆支持
function tudouPlayer(){
	var array = Player.GxcmsUrl();
	tudouStr = '<embed allowNetworking="internal" allowFullScreen="true" allowscriptaccess="never" src="http://www.tudou.com/v/'+array['url']+'/dW5pb25faWQ9MTAzMzcwXzEwMDAwMV8wMl8wMQ/&videoClickNavigate=false&withRecommendList=false&withFirstFrame=false&autoPlay=true/v.swf"  type="application/x-shockwave-flash" width="100%" height="'+Player.Height+'"></embed>';
	document.write(tudouStr);
}
tudouPlayer();
