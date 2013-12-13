//播放器控件
function $Showhtml(){
	player='<object classid="clsid:F587310D-5306-494D-87E2-88334B46E781" width="100%" height="'+Player.Height+'" id="BfPlayer" name="BfPlayer" style="margin-top:-1px" onerror="Player.Install();"></object>';
	return player;
}
Player.Show();
//加载完成时
BfPlayer.attachEvent("OnLoadPlayer",function(){
	var stormURL = Player.Url.substring(0, Player.Url.length - 1)+"||pid=union||channel=union/666/index.html";
	BfPlayer.AddURL(stormURL, true, 0, 0);
	bf_log.pv("union/666/no_notice.html");
});
//播放出错
BfPlayer.attachEvent("OnError",function(nCatalog, nErrorCode){
	alert('播放影片出错,请按F5刷新网页试试！');
});
//暴风统计
var bf_log = {
	'pv_url': 'http://pvlog.moviebox.baofeng.net/log.php?',
	'bf_uid': null,
	'send': function(url) {
		window['sendLog'] = new Image();
		window['sendLog'].src = url;
	},
	'pv': function(id) {
		var url = [this.pv_url];
		url.push('channel=' + id);
		url.push('&type=manual');
		url.push('&page=0');
		url.push('&linksrc=null');
		url.push('&uid=' + BfPlayer.GetNamedValue("userID"));
		url.push('&r=' + Math.random());
		this.send(url.join(''));
	}
};