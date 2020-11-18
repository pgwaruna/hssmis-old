var xmlHttp;

function changecomb(student)
{ 


xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var combin=document.getElementById('combi').value;


if(combin=="0"){
	alert("Please Select Course Combination ! ");
return;
	}
else{

	var url="Ajax/comb_edit.php";
	url=url+"?std="+student+"&comb="+combin;

	document.getElementById('loader7').style.visibility= 'visible';

	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);

}
function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById('combination').innerHTML=xmlHttp.responseText;

document.getElementById('loader7').style.visibility= 'hidden';
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

