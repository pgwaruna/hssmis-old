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






var xmlHttp;

function create()
{ 

xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loader4").style.visibility= 'visible';
//document.getElementById("button_mod").style.disabled= 'true';

//var y=document.getElementById("y1").value;
//var m=document.getElementById("m1").value;
//var d=document.getElementById("d1").value;
//var date=y+"-"+m+"-"+d;
var dateq=document.getElementById("date2").value;

var h=document.getElementById("hours1").value;

var subject=document.getElementById("subject_name").value;
var t=document.getElementById("time1").value;
var type=document.getElementById("type1").value;

var pgp=document.getElementById("swgrp").value;
if(pgp!="nogrp"){
var expn=document.getElementById("exptno").value;
}
var url="Ajax/create_lect.php";
url=url+"?date1="+dateq+"&h1="+h+"&t1="+t+"&type1="+type+"&subject="+subject+"&pgp1="+pgp+"&expn1="+expn;

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);


function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("create_l").innerHTML=xmlHttp.responseText;
document.getElementById("loader4").style.visibility= 'hidden';
} 
}

}






