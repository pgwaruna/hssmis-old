var xmlHttp;

function displayGrp()
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loadergp").style.visibility= 'visible';
var url="Ajax/display_courses.php";
var dept=document.getElementById('type1').value;
var sgp="showgp";
url=url+"?dept="+dept+"&sgp="+sgp;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById('dispgrp').innerHTML=xmlHttp.responseText;
document.getElementById("loadergp").style.visibility= 'hidden';

} 
}
}










function displayGrp2()
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loadergp").style.visibility= 'visible';
var url="Ajax/display_courses.php";
var dept=document.getElementById('type2').value;
var sgp="showgp";
url=url+"?dept="+dept+"&sgp="+sgp;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById('dispgrp').innerHTML=xmlHttp.responseText;
document.getElementById("loadergp").style.visibility= 'hidden';

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





