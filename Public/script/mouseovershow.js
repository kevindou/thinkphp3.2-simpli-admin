
function $1(id){return document.getElementById(id);}
function showTxt(number){for(var i=1;i<=7;i++){if(i==number){if($1("hd_"+i))$1("hd_"+i).style.display="inline";}else{if($1("hd_"+i))$1("hd_"+i).style.display="none";}}}
function optMsg(type){document.getElementById("float_01").style.display=type;}
function changeTuring(id){var obj=document.getElementById(id);obj.src=obj.src+="?"+Math.random();}
function setTab(name,cursel,n){for(i=1;i<=n;i++){var menu=document.getElementById(name+i);var con=document.getElementById("con_"+name+"_"+i);menu.className=i==cursel?"hover":"";con.style.display=i==cursel?"block":"none";}}
function show(div){document.getElementById(div).style.display="block";}
function hide(div){document.getElementById(div).style.display="none";}
function setTab03Syn(i1)
{selectTab03Syn(i1);}
function selectTab03Syn(i1)
{switch(i1){case 1:document.getElementById("TabTab03Con1").style.display="block";document.getElementById("TabTab03Con2").style.display="none";break;case 2:document.getElementById("TabTab03Con1").style.display="none";document.getElementById("TabTab03Con2").style.display="block";break;}}
function setTab03Syns(is1)
{selectTab03Syns(is1);}
function selectTab03Syns(is1)
{switch(is1){case 3:document.getElementById("TabTab03Cons3").style.display="block";document.getElementById("TabTab03Cons4").style.display="none";break;case 4:document.getElementById("TabTab03Cons3").style.display="none";document.getElementById("TabTab03Cons4").style.display="block";break;}}
function setTab03Synss(iss1)
{selectTab03Synss(iss1);}
function selectTab03Synss(iss1)
{switch(iss1){case 5:document.getElementById("TabTab03Conss5").style.display="block";document.getElementById("TabTab03Conss6").style.display="none";document.getElementById("TabTab03Conss7").style.display="none";document.getElementById("TabTab03Conss8").style.display="none";document.getElementById("TabTab03Conss9").style.display="none";document.getElementById("TabTab03Conss10").style.display="none";break;case 6:document.getElementById("TabTab03Conss5").style.display="none";document.getElementById("TabTab03Conss6").style.display="block"
document.getElementById("TabTab03Conss7").style.display="none";document.getElementById("TabTab03Conss8").style.display="none";document.getElementById("TabTab03Conss9").style.display="none";document.getElementById("TabTab03Conss10").style.display="none";break;case 7:document.getElementById("TabTab03Conss5").style.display="none";document.getElementById("TabTab03Conss6").style.display="none"
document.getElementById("TabTab03Conss7").style.display="block";document.getElementById("TabTab03Conss8").style.display="none";document.getElementById("TabTab03Conss9").style.display="none";document.getElementById("TabTab03Conss10").style.display="none";break;case 8:document.getElementById("TabTab03Conss5").style.display="none";document.getElementById("TabTab03Conss6").style.display="none"
document.getElementById("TabTab03Conss7").style.display="none";document.getElementById("TabTab03Conss8").style.display="block";document.getElementById("TabTab03Conss9").style.display="none";document.getElementById("TabTab03Conss10").style.display="none";break;case 9:document.getElementById("TabTab03Conss5").style.display="none";document.getElementById("TabTab03Conss6").style.display="none"
document.getElementById("TabTab03Conss7").style.display="none";document.getElementById("TabTab03Conss8").style.display="none";document.getElementById("TabTab03Conss9").style.display="block";document.getElementById("TabTab03Conss10").style.display="none";break;case 10:document.getElementById("TabTab03Conss5").style.display="none";document.getElementById("TabTab03Conss6").style.display="none"
document.getElementById("TabTab03Conss7").style.display="none";document.getElementById("TabTab03Conss8").style.display="none";document.getElementById("TabTab03Conss9").style.display="none";document.getElementById("TabTab03Conss10").style.display="block";break;}}
function setTab03Synsss(isss1)
{selectTab03Synsss(isss1);}
function selectTab03Synsss(isss1)
{switch(isss1){case 21:document.getElementById("TabTab03Consss21").style.display="block";document.getElementById("TabTab03Consss22").style.display="none";break;case 22:document.getElementById("TabTab03Consss21").style.display="none";document.getElementById("TabTab03Consss22").style.display="block";break;}}
function setTab03Synsssa(isssa1)
{selectTab03Synsssa(isssa1);}
function selectTab03Synsssa(isssa1)
{switch(isssa1){case 31:document.getElementById("TabTab03Consssa31").style.display="block";document.getElementById("TabTab03Consssa32").style.display="none";document.getElementById("TabTab03Consssa33").style.display="none";break;case 32:document.getElementById("TabTab03Consssa31").style.display="none";document.getElementById("TabTab03Consssa32").style.display="block";document.getElementById("TabTab03Consssa33").style.display="none";break;case 33:document.getElementById("TabTab03Consssa31").style.display="none";document.getElementById("TabTab03Consssa32").style.display="none";document.getElementById("TabTab03Consssa33").style.display="block";break;}}
function setTab03Synsssb(isssb1)
{selectTab03Synsssb(isssb1);}
function selectTab03Synsssb(isssb1)
{switch(isssb1){case 41:document.getElementById("TabTab03Consssb41").style.display="block";document.getElementById("TabTab03Consssb42").style.display="none";document.getElementById("TabTab03Consssb43").style.display="none";break;case 42:document.getElementById("TabTab03Consssb41").style.display="none";document.getElementById("TabTab03Consssb42").style.display="block";document.getElementById("TabTab03Consssb43").style.display="none";break;case 43:document.getElementById("TabTab03Consssb41").style.display="none";document.getElementById("TabTab03Consssb42").style.display="none";document.getElementById("TabTab03Consssb43").style.display="block";break;}}
var meiTiIndex=1;var stopPoint=1;function gunDongMeiTi(){meiTiZhuanQuId="meitizhuanqu"+meiTiIndex;$("#"+meiTiZhuanQuId).click();meiTiIndex++;if(meiTiIndex==7){meiTiIndex=1;}
setTimeout("gunDongMeiTi()",5000);}
function stopGunDong(){stopPoint=meiTiIndex;meiTiIndex=8;}
function restartGunDong(){meiTiIndex=stopPoint;}
gunDongMeiTi();