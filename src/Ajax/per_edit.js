var xmlHttp;

function changeper(role, per, status)
{ 


xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
name=prompt("Enter Display Name");
group=prompt("Enter Group Name");
var url="Ajax/per_edit.php";
url=url+"?role="+role+"&per="+per+"&status="+status+"&name="+name+"+&group="+group;

var imgid="img-"+role+"-"+per;

document.getElementById(imgid).src='images/ajax-loader.gif';
var divid="div-"+role+"-"+per;

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(divid).innerHTML=xmlHttp.responseText;

//document.getElementById(imgid).style.visibility= 'hidden';
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

