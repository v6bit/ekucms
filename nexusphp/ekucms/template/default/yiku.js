$(document).ready(function(){
	
	
	//内容页同类热门影视
	if($("#hot_video").length>0){
		$("#hot_video").load($("#hot_video").attr('href'));	
	}
	
	if($("#play_old_list_a").length>0){
		$('#play_old_list_a').bind('mouseover',function(){
			showPlayOld();
		});
	}
	
	if($("#login_btn").length>0){
		$('#login_btn').bind('click',function(){
			showLogin(this);
		});
	}
	
	ScoreShow($('#Scores').attr("alttext"));
	
	
	//鼠标点击
	$("#Scores>span").click(function(){
		//刷新星级图标
		$.ajax({
			type: 'get',
			url: SitePath+'index.php?s='+GetModel(SiteMid)+'/score/id/'+SiteId+'/ajax/'+($(this).attr('id')*1+1),
			success:function($html){
				if($html=='0'){
					alert('您已评价过了');
				}else{
					
				}
			}
		});
	});	
	
	
	
	
	//搜索提示
	if($("#wd").length>0){
		$('#wd').bind('click',function(){
			searchSuggest();
		});
		
		$('#wd').bind('keyup',function(e){
			
			var ev = e || window.event;//获取event对象  
			var obj = ev.target || ev.srcElement;//获取事件源  
			var t = obj.type || obj.getAttribute('type');//获取事件源类型 
			
			var currKey=0,e=e||event;
			var is = false;
			if (ev.keyCode == 40 || ev.keyCode == 38)
			{
				is = true;
			}
			if (is == false)
			{
				searchSuggestAction();
			}
			
		});
	}
	
	
	/*
	$("#searchSuggestContent").click(function(event){
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
	});
*/	
	
	$("#play_old_list_a").click(function(event){
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
	});
	
	$("#play_old_list").click(function(event){
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
	});
	
	
	$("#wd").click(function(event){
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
	});
	
	$("#login_btn").click(function(event){
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
	});
	
	$("#login_box").click(function(event){
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
	});
	
	
	
	document.onclick = function(){
		$("#searchSuggestContent").hide();
		$('#play_old_list').hide();
		$('#login_box').hide();
		
	};
});


function showLogin(obj)
{
	
	//console.log(obj); login_box
	
	if ($('#login_box').css('display') == 'block')
	{
		$('#login_box').hide();
	}else{
		var offset = $('#login_btn').offset();
		var left = parseFloat(offset.left) - 60;
		$('#login_box').css('left',left+'px');
		$('#login_box').css('top','50px');
		$('#login_box').fadeIn(100);
	}
}

function showPlayOld()
{
	if ($('#play_old_list').css('display') == 'block')
	{
		$('#play_old_list').hide();
	}else{
		
		
		
		var result=getCookie("gxhis");
		if(result==null)
		{
			var cc = '';
			cc += '<div class="d5" style="text-align:center;color:#F00;">暂无观看记录</div>';;
			cc +=' <div class="jilu1-3"><a href="javascript:void(0);" onclick="'+bb+'"class="qk">全部清空</a><a href="#">帐号登录>></a></div>';
			document.getElementById("play_old_list_content").innerHTML = cc;
		}
		else
		{
			var bb="delCookie('gxhis')";
			//var cc='<div class="d5" style="text-align:right;"><a href="javascript:void(0);" onclick="'+bb+'">清空观看记录</a></div>';
			var cc='';
			
			var arr=result.split("ttt");
			if(arr.length>6)
			{
				for(var i=5;i>-1;i--)
				{
					var act=arr[i].split('ddd');
					if(act[0]!="")
					{
						//cc='<div class="list"><a href="'+act[1]+'" title="'+act[0]+'" class="title">'+act[0].substr(0,10)+'</a><a href="'+act[1]+'"  style="color:#4E8000;">继续观看</a></div>'+cc;
						cc='<a href="'+act[1]+'" class="jilu1-2"><span class="jilu3-1">'+act[0].substr(0,10)+'</span></a>'+cc;
					}
				}
			}
			else
			{
				for(var i=arr.length-1;i>-1;i--)
				{
					var act=arr[i].split('ddd');
					if(act[0]!="")
					{
						//cc='<div class="list"><a href="'+act[1]+'" title="'+act[0]+'"  class="title">'+act[0].substr(0,10)+'</a><a href="'+act[1]+'"  style="color:#4E8000;">继续观看</a></div>'+cc;
						cc='<a href="'+act[1]+'" title="点击继续观看该影片" class="jilu1-2"><span class="jilu3-1">'+act[0].substr(0,10)+'</span></a>'+cc;
					}
				}
			}
			
			cc +=' <div class="jilu1-3"><a href="javascript:void(0);" onclick="'+bb+'"class="qk">全部清空</a></div>';
			document.getElementById("play_old_list_content").innerHTML=cc;
		}
		
		
		
		
		
		
		
		
		
		
		
		$('#play_old_list').fadeIn(100);
	}
	
}


function video_index_tag_change(cur,count,obj1,obj2,style1,style2,style3,style4)
{
	var i = 1;
	var cur = parseInt(cur);
	var count = parseInt(count);
	for(var i=1;i<=count;i++)
	{
		if (i == cur)
		{
			$('#'+obj1+i).removeClass(style2);
			$('#'+obj1+i).addClass(style1);
			$('#'+obj2+i).css('display','block');
			
		}else{
			$('#'+obj1+i).removeClass(style1);
			$('#'+obj1+i).addClass(style2);
			$('#'+obj2+i).css('display','none');
		}
	}
}

function video_detail_tag_change(cur,count,obj1,obj2,style1,style2,style3,style4)
{
	var i = 1;
	var cur = parseInt(cur);
	var count = parseInt(count);
	for(var i=1;i<=count;i++)
	{
		
		if (i == cur)
		{
			$('#'+obj1+i).removeClass(style2);
			$('#'+obj1+i).addClass(style1);
			
			$('#'+obj2+i).removeClass(style4);
			$('#'+obj2+i).addClass(style3);
			
			//$('#play_ji_desc_'+i).addClass(style3);
			
			
		}else{
			$('#'+obj1+i).removeClass(style1);
			$('#'+obj1+i).addClass(style2);
			
			$('#'+obj2+i).removeClass(style3);
			$('#'+obj2+i).addClass(style4);
		}
		
		$('#play_ji_desc_'+i).removeClass(style3);
		$('#play_ji_desc_'+i).addClass(style4);
	}
}

function video_detail_tag_change2(cur,count,obj1,obj2,style1,style2,style3,style4)
{
	var i = 1;
	var count = parseInt(count);
	for(var i=1;i<=count;i++)
	{
		var attr = $('#'+obj1+i).attr('type');
		
		if (attr == cur)
		{
			$('#'+obj1+i).removeClass(style2);
			$('#'+obj1+i).addClass(style1);
			
			$('#'+obj2+i).removeClass(style4);
			$('#'+obj2+i).addClass(style3);
			
		}else{
			$('#'+obj1+i).removeClass(style1);
			$('#'+obj1+i).addClass(style2);
			
			$('#'+obj2+i).removeClass(style3);
			$('#'+obj2+i).addClass(style4);
		}
	}
}



function searchSuggest()
{
	$('#searchSuggestContent').html('');
	$('#searchSuggestContent').fadeIn(100);;
}

function searchSuggestAction()
{
	var v = $('#wd').val();
	if (v)
	{
		var url = SitePath+'index.php?s=video/searchSuggest/wd/'+encodeURI(v);
		$.getJSON(url,function(data){
			searchSuggestReturn(data);
		});
	}else{
		$('#searchSuggestContent').html('');
	}
	return;
}

function searchSuggestReturn(data)
{
	var count  = parseInt(data['c']);
	$('#searchSuggestContent').html('');
	if (count > 0)
	{
		var data = data['result'];
		var html = '<ul>';
		for(var i=0;i<count;i++)
		{
			html += '<li alttext="'+data[i]['oldtitle']+'"><a href="'+data[i]['readurl']+'"  target="_blank">'+data[i]['title']+'</a><a href="#" class="ss1-3">'+data[i]['tname']+'</a></li>';
			//html += '<a href="'+data[i]['readurl']+'" target="_blank">'+data[i]['title']+'</a>';
		}
		html += '</ul>';
		html += '<div class="ss1-2">搜索到'+count+'条的相关结果</div>';
	}else{
		html = '<span>没有找到相关影片！</span>';
	}
	
	$('#searchSuggestContent').html(html);
}



   function CheckAdd(name,ckname,url,num){
        var result=VgetCookie(ckname);
        var str;
        if(result==null){
          result="";
        }
       if(num!=''){
          name=name+' '+num;
        }
        str=name+"ddd"+url+"ttt";
        if(result.indexOf(name)>=0){ //删除同片历史记录
              result= result.replace(str,"");
        }
          result=str+result;
          VSetCookie(ckname,result);
   }


	var hoverBackgroundColor = "#ffffff";
	var hoverTextColor = "#025196";
	
	function VSetCookie(name,value)
	{
		var Days = 30; //cookie 将被保存 30 天
		var exp  = new Date();   //new Date("December 31, 9998");
		exp.setTime(exp.getTime() + Days*24*60*60*1000);
		document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
	}
	function VgetCookie(name)//取cookies函数        
	{
		var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
		if(arr != null) return unescape(arr[2]); return null;
	}

	function fnRemoveHighlight(mnuName)
	{
	  var elem = document.getElementById(mnuName + "Link");
	  elem.style.backgroundColor ='';// hoverBackgroundColor;
	  elem.style.color = "#025196"; //hoverBackgroundColor;
	}

	
	function getCookie(name)//取cookies函数        
	{
		var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
		 if(arr != null) return unescape(arr[2]); return null;
	
	}
	
	function delCookie(name)//删除cookie
	{
		var exp = new Date();
		exp.setTime(exp.getTime() - 1);
		var cval=getCookie(name);
		if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
		alert('历史记录已经清空，请刷新页面！');
	}

var cindex = -1;    //标记上下键时所处位置
var currentTxt = $("#wd").val();
document.onkeydown = function(e)
{ 
	var ev = e || window.event;//获取event对象  
    var obj = ev.target || ev.srcElement;//获取事件源  
    var t = obj.type || obj.getAttribute('type');//获取事件源类型  
	
	 
	switch(ev.keyCode)
	{
		case 40:
						if (++cindex == $("#searchSuggestContent li").length) {  //判断加一操作后index值是否超出列表数目界限  
                               cindex = -1;             //超出的话就将index值变为初始值  
                               $("#wd").val(currentTxt);    //并将文本框中值设为用户用于搜索的值  
                               $("#searchSuggestContent li").removeClass("wbfwbf");  
                           }  
                          else {  
                               $("#wd").val($($("#searchSuggestContent li")[cindex]).attr('alttext'));  
                               $($("#searchSuggestContent li")[cindex]).siblings().removeClass("wbfwbf").end().addClass("wbfwbf");  
                            }  
			break;
		case 38:
		
                          if (--cindex == -1) {    //判断自减一后是否已移到文本框  
                             $("#wd").val(currentTxt);  
                              $("#searchSuggestContent li").removeClass("wbfwbf");  
                           }  
                           else if (cindex == -2) {     //判断index值是否超出列表数目界限  
                               cindex = $("#searchSuggestContent li").length - 1;  
                                $("#wd").val($($("#searchSuggestContent li")[cindex]).attr('alttext'));  
                               $($("#searchSuggestContent li")[cindex]).siblings().removeClass("wbfwbf").end().addClass("wbfwbf");  
                           }  
                            else {  
                                $("#wd").val($($("#searchSuggestContent li")[cindex]).attr('alttext'));  
                              $($("#searchSuggestContent li")[cindex]).siblings().removeClass("wbfwbf").end().addClass("wbfwbf");  
                         } 		
		
			break;
		case 13:
			break;
		default:break;
	}
}

function ScoreShow($score)
{
	var $html = '';
	$score = parseFloat($score)/2;
	for(var i = 0 ; i<5; i++){
		var classname = 'all';
		if(i < $score && i<Math.round($score)){
			if(i == parseInt($score)){
				classname = 'half';
			}
		}else{
			classname = 'none';
		}
		$html += '<span id="'+i+'" class="'+classname+'"></span>';// title="'+ScoreTitle(i*2)+'"
	}
	//alert($html);
	$('#Scores').html($html);
}