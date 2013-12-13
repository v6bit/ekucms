//ckplayer 播放器支持
function objckplayer()
{
		var array = Player.GxcmsUrl();
		var _nextu=3;
		if(array["nextcacheurl"]){
			_nextu=0;
		}
		/*
		html='<embed src="/ckplayer59/ckplayer.swf" flashvars="f='+array["url"]+'&my_url='+encodeURIComponent(window.location.href)+'&e='+_nextu+'" quality="high" width="'+Player.Width+'" height="'+Player.Height+'" align="middle" allowScriptAccess="always" allowFullscreen="true" type="application/x-shockwave-flash"></embed>';
		document.write(html);
		*/
		
	var flashvars={
		f:ckplayer_f_u+'ck6/video.php?url=[$pat]',//视频地址
		a:array['url'],//调用时的参数，只有当s>0的时候有效
		s:'2',//调用方式，0=普通方法（f=视频地址），1=网址形式,2=xml形式，3=swf形式(s>0时f=网址，配合a来完成对地址的组装)
		c:'0',//是否读取文本配置,0不是，1是
		x:'',//调用xml风格路径，为空的话将使用ckplayer.js的配置
		i:ckplayer_first_pic,//初始图片地址
		d:ckplayer_f_p,//暂停时播放的广告，swf/图片,多个用竖线隔开，图片要加链接地址，没有的时候留空就行
		u:ckplayer_f_p_l,//暂停时如果是图片的话，加个链接地址
		l:ckplayer_f_ad,//前置广告，swf/图片/视频，多个用竖线隔开，图片和视频要加链接地址
		r:'',//前置广告的链接地址，多个用竖线隔开，没有的留空
		t:ckplayer_f_ad_s,//视频开始前播放swf/图片时的时间，多个用竖线隔开
		y:'',//这里是使用网址形式调用广告地址时使用，前提是要设置l的值为空
		z:ckplayer_buffer_ad,//缓冲广告，只能放一个，swf格式
		e:'3',//视频结束后的动作，0是调用js函数，1是循环播放，2是暂停播放，3是调用视频推荐列表的插件，4是清除视频流并调用js功能和1差不多
		v:'80',//默认音量，0-100之间
		p:'1',//视频默认0是暂停，1是播放
		h:'4',//播放http视频流时采用何种拖动方法，=0不使用任意拖动，=1是使用按关键帧，=2是按时间点，=3是自动判断按什么(如果视频格式是.mp4就按关键帧，.flv就按关键时间)，=4也是自动判断(只要包含字符mp4就按mp4来，只要包含字符flv就按flv来)
		q:'',//视频流拖动时参考函数，默认是start
		m:'0',//默认是否采用点击播放按钮后再加载视频，0不是，1是,设置成1时不要有前置广告
		g:'',//视频直接g秒开始播放
		j:'',//视频提前j秒结束
		b:'0x000',//播放器的背景色，如果不设置的话将默认透明
		w:'',//指定调用自己配置的文本文件,不指定将默认调用和播放器同名的txt文件
		//调用播放器的所有参数列表结束
		//以下为自定义的播放器参数用来在插件里引用的
		my_url:encodeURIComponent(window.location.href)//本页面地址
		//调用自定义播放器参数结束
		};
	var params={bgcolor:'#000',allowFullScreen:true,allowScriptAccess:'always'};//这里定义播放器的其它参数如背景色（跟flashvars中的b不同），是否支持全屏，是否支持交互
	var attributes={id:'ckplayer_a1',name:'ckplayer_a1'};
	//下面一行是调用播放器了，括号里的参数含义：（播放器文件，要显示在的div容器，宽，高，需要flash的版本，当用户没有该版本的提示，加载初始化参数，加载设置参数如背景，加载attributes参数，主要用来设置播放器的id）
	swfobject.embedSWF('/ck6/ckplayer.swf', 'GxPlayer', Player.Width, Player.Height, '10.0.0','/ck6/expressInstall.swf', flashvars, params, attributes); //播放器地址，容器id，宽，高，需要flash插件的版本，flashvars,params,attributes	
	//调用ckplayer的flash播放器结束
	
		
		
}



	/*
	=================================================================
	
	以下代码并不是播放器里的，只是播放器应用时用到的
	
	=================================================================
	*/
	
	/*
	function playerstop(){
		//只有当调用视频播放器时设置e=0或4时会有效果
		alert('播放完成');	
	}
	var _nn=0;//用来计算实时监听的条数的，超过100条记录就要删除，不然会消耗内存
	function ckplayer_status(str){
		_nn+=1;
		if(_nn>100){
			_nn=0;
			document.getElementById('statusvalue').value='';
		}
		document.getElementById('statusvalue').value=str+'\n'+document.getElementById('statusvalue').value;
	}
	function aboutstr(str,f){//查看str字符里是否有f
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
	function ckadjump(){
		alert("你点击了跳过广告按钮，注册成为本站会员，可不用观看前置广告");
	}
	//开关灯
	var box = new LightBox('flashcontent');
	var $=function(id){return document.getElementById(id)};
	function closelights(){//关灯
		box.Show();
		$('video').style.width='940px';
		$('video').style.height='550px';
		swfobject.getObjectById('ckplayer_a1').width=940;
		swfobject.getObjectById('ckplayer_a1').height=550;
	}
	function openlights(){//开灯
		box.Close();
		$('video').style.width='600px';
		$('video').style.height='400px';
		swfobject.getObjectById('ckplayer_a1').width=600;
		swfobject.getObjectById('ckplayer_a1').height=400;
	}
	*/

objckplayer();