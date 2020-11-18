var xmlHttp;


function modify(lect)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loader2").style.visibility= 'visible';
//document.getElementById("button_mod").style.disabled= 'true';
//var y=document.getElementById("y").value;
//var m=document.getElementById("m").value;
//var d=document.getElementById("d").value;
//var date=y+"-"+m+"-"+d;
var date3=document.getElementById("date2").value;
var h=document.getElementById("hours").value;
var t=document.getElementById("time").value;
var type=document.getElementById("type2").value;
var mpgp=document.getElementById("swgrp").value;

if(mpgp!="nogrp"){
var expn=document.getElementById("exptno").value;
}


var url="Ajax/modify_lect.php";
url=url+"?date="+date3+"&lect="+lect+"&h="+h+"&t="+t+"&type="+type+"&mpgp="+mpgp+"&expn="+expn;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);


function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("modify_lect_info").innerHTML=xmlHttp.responseText;
document.getElementById("loader2").style.visibility= 'hidden';
} 
}

}










var xmlHttp;
function remove2(lect)
{ 

xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loader2").style.visibility= 'visible';
document.getElementById("button_rem").style.disabled= 'true';

var url="Ajax/remove.php";
url=url+"?lect="+lect;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);


function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("remove_lect_info").innerHTML=xmlHttp.responseText;
document.getElementById("loader2").style.visibility= 'show';
} 
}

}


















function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

