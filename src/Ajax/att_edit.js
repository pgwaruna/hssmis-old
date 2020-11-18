var xmlHttp;

function changeAtt(lecture, student, status)
{ 


xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var url="Ajax/att_edit.php";
url=url+"?lecture1="+lecture+"&student1="+student+"&status1="+status;
var imgid=lecture+"-img-"+student;
document.getElementById(imgid).src='images/ajax-loader.gif';
var divid=lecture+"-att-"+student;

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(divid).innerHTML=xmlHttp.responseText;
counter(lecture);
//document.getElementById(imgid).style.visibility= 'hidden';
} 
}
}




var xmlHttp;
function counter(lecture)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var url="Ajax/counter.php";
url=url+"?lecture="+lecture;

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById('count_now').innerHTML=xmlHttp.responseText;

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

