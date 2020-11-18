var xmlHttp;

function display_torp()
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("ldrtop").style.visibility= 'visible';
var url="Ajax/dis_tp_72.php";
var ptype=document.getElementById('anlstype').value;
url=url+"?ptype="+ptype;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById('disptop').innerHTML=xmlHttp.responseText;
document.getElementById("ldrtop").style.visibility= 'hidden';

} 
}
}






function display_torp_all(no)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
var gtldrtop="ldrtop"+no;
var gtdisptop="disptop"+no
var anlstype="anlstype"+no;



document.getElementById(gtldrtop).style.visibility= 'visible';
var url="Ajax/dis_tp_72.php";
var ptype=document.getElementById(anlstype).value;
url=url+"?ptype="+ptype;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(gtdisptop).style.visibility= 'visible';
document.getElementById(gtdisptop).innerHTML=xmlHttp.responseText;
document.getElementById(gtldrtop).style.visibility= 'hidden';

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

