// JavaScript Document
$(function(){
	/*---人气榜js---*/
	$(".rb1 span").click(function(){
		var index=$(".rb1 span").index(this);
		$(".rb1 span").attr("class","");
		$(".rb1 span:eq("+index+")").attr("class","on1");
		$(".ph1").hide();
		$(".ph1:eq("+index+")").show();
	});
	
	/*---列表js---*/
	$(".list1 span").click(function(){
		var index=$(".list1 span").index(this);
		$(".list1 span").attr("class","");
		$(".list1 span:eq("+index+")").attr("class","on4");
		$(".list1-3").hide();
		$(".list1-3:eq("+index+")").show();
	});
	
});












