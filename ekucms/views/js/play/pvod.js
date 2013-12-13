function $Showhtml(){
	player ='<object width="100%" height="'+Player.Height+'" classid="clsid:A74BF134-5213-46B5-AF36-CE1888315DC7" onError="Player.Install();">';
	player +='<PARAM NAME="URL" VALUE="'+Player.Url+'">';
	player +='<PARAM NAME="lActiveXStyle" VALUE="1">';
	player +='</object>';
	return player;
}
Player.Show();