var xmlHttp;


function dispdata(status, fstno, herg, visn, phydisabi, supt, sptspe, takemedi, medicspe)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loader").style.visibility= 'visible';
var url="../Ajax/disable_form.php";
url=url+"?status="+status+"&fstno="+fstno+"&herg="+herg+"&visn="+visn+"&phydisabi="+phydisabi+"&supt="+supt+"&sptspe="+sptspe+"&takemedi="+takemedi+"&medicspe="+medicspe;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("disabl").innerHTML=xmlHttp.responseText;
document.getElementById("loader").style.visibility= 'hidden';
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
