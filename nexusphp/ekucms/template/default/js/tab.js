// JavaScript Document

function change(obj){
		var divObj=document.getElementsByTagName("div");
		for(var i=0;i<divObj.length;i++){
			if(divObj[i].className=="on"){
				divObj[i].className="off";
			}
			if(divObj[i].className=="show"){
				divObj[i].className="hide";
			}
		}
		obj.className="on";
		var showObjId=obj.title;
		var showObj=document.getElementById(showObjId);
			showObj.className="show";
	}