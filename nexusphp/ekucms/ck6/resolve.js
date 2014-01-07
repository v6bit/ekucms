function Extension(str){
	var ext='';
	if(str){
		var file=str.toLowerCase();	
		var filearr=file.split('.');
		var exten=filearr[filearr.length-1];
		if(exten=='flv' || exten=='f4v' || exten=='mp4' || exten=='rmov'){
			ext='video';	
		}
	}
	return ext;
}
function aboutstr(str,f){
	var about=false;
	var strarray=new Array();
	var farray=new Array();
	farray=f.split(",");
	if(str){
		for(var i=0;i<farray.length;i++){
			strarray=str.split(farray[i]);
			if(strarray.length>1){
				about=true;
				break;
			}
		}
	}
	return about;
}
function formaturl(str){//返回格式化后的地址
	var style=flestyle(str);
	var pat='';
	switch(style){
		case 'youku':
			pat=formatyouku(str);
			break;
		case 'tudou':
			pat=formattudou(str);
			break;
		case 'letv':
			pat=formatletv(str);
			break;
		default:
			break;
	}
	return pat;
}
function formatletv(str){
	var url=str;
	var arr=new Array();
	if(aboutstr(str,'swf?id=')){
		arr=str.split('&');
		url=arr[0];
		arr=url.split('=');
		url=arr[1];
	}
	else{
		url=url.replace('_wd3','')	
	}
	url+='_wd3';
	return url
}
function formattudou(str){
	var url=str;
	var arr=new Array();
	if(aboutstr(str,'tudouui.com')){
		arr=str.split('=');
		url=arr[1];
	}
	else{
		url=url.replace('_wd2','')	
	}
	url+='_wd2';
	return url
}
function formatyouku(str){
	var url=str;
		url=url.replace('_wd1','');
		url=url.replace('http://v.youku.com/v_show/id_','');
		url=url.replace('.html','');
		url=url.replace('http://player.youku.com/player.php/sid/','');
		url=url.replace('/v.swf','');
		url+='_wd1';
	return url
}
//alert(formaturl("150791246_wd2"));
function flestyle(str){//判断文件类型
	var style='';//定义类型
	if(aboutstr(str,'youku.com') || aboutstr(str,'_wd1')){
		style='youku';
	}
	if(aboutstr(str,'tudouui.com') || aboutstr(str,'_wd2')){
		style='tudou';
	}
	if(aboutstr(str,'letv.com') || aboutstr(str,'_wd3')){
		style='letv';
	}
	return style;
}