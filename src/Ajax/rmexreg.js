var xmlHttp;

function removeexreg(id)
{ 

var where_to= confirm("Do you really want Remove this Registration.?....if yes, Click  [OK]...");

 if (where_to== true)
 {
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	 {
	 alert ("Browser does not support HTTP Request");
	 return;
	 }
	 
	var url="./Ajax/rmexreg.php";
	url=url+"?rmcourseid="+id;
	var divid=id;

	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
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

