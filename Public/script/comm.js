// JavaScript Document
$(function(){
	getCert();
})

function getCert(){
	return nima_cert;	
}
//JS选项卡
function Show_ALL_tabs(TotalNum,IDType,NowID,YArr){
	var menuName=IDType+"_Menu_";
	var contentName=IDType+"_Content_";
	var menuYArr=YArr.split("_");
	for(var i=0;i<TotalNum;i++){
		document.getElementById(contentName+i).style.display="none";
		document.getElementById(menuName+i).style.backgroundPosition="0 "+menuYArr[i]+"px";
		document.getElementById(menuName+i).style.color="#6A5027";
	}
	document.getElementById(contentName+NowID).style.display="block";
}
function changecor(id){
		document.getElementById(id).style.color="#ff4500";
}
function winOpen()
{
	$('#wbox_serv1').click();
}

function switchTab(tabId,modName,tabName,num){
	for(i=1;i<=num;i++){
		$("#"+modName+i).hide();	
		$("#"+tabName+tabId).attr("class","tab");
	}
	$("#"+modName+tabId).show();
	$("#"+tabName+tabId).attr("class","tab tabhover");
}

function outTab(modName,tabId,num){
	for(i=1;i<=num;i++){
		$("#"+modName+i).attr("class","tab");
		//alert(modName);
	}
	$("#"+tabId).attr("class","tab tabhover");



}
