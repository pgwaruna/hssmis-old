var xmlHttp;
//level filter function...........................
function levelfilter2(stnum)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var loader2="ldr2"+stnum;
document.getElementById(loader2).src='./images/ajax-loader.gif';
document.getElementById(loader2).style.visibility= 'visible';

//alert(loader2);
var lvl=stnum+"level";
var a = document.getElementById(lvl);
var rlevel = a.options[a.selectedIndex].value;

var result="result2"+stnum;


var url="./Ajax/result_filt.php";
url=url+"?task=lvlfilt"+"&stnum="+stnum+"&rlevel="+rlevel;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);



function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 

document.getElementById(result).innerHTML=xmlHttp.responseText;
document.getElementById(loader2).style.visibility= 'hidden';

} 
}
}
//.......................................................
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
//semester filter function.................................

function semesterfilter(stnum)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var loader="ldr2"+stnum;
document.getElementById(loader).src='./images/ajax-loader.gif';
document.getElementById(loader).style.visibility= 'visible';


var lvl=stnum+"level";
var a = document.getElementById(lvl);
var rlevel = a.options[a.selectedIndex].value;

var seme=stnum+"semester";
var b = document.getElementById(seme);
var csemester = b.options[b.selectedIndex].value;

var result="result2"+stnum;


var url="./Ajax/result_filt.php";
url=url+"?task=semefilt"+"&stnum="+stnum+"&rlevel="+rlevel+"&csemester="+csemester;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);



function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(result).innerHTML=xmlHttp.responseText;
document.getElementById(loader).style.visibility= 'hidden';
} 
}
}

//..................................................
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
//subject filter function.................................
function subjectfilter(stnum)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var loader="ldr2"+stnum;
document.getElementById(loader).src='./images/ajax-loader.gif';
document.getElementById(loader).style.visibility= 'visible';


var sub=stnum+"subcd";
var subcode = document.getElementById(sub).value;


var result="result2"+stnum;


var url="./Ajax/result_filt.php";
url=url+"?task=subfilt"+"&stnum="+stnum+"&subcode="+subcode;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);



function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(result).innerHTML=xmlHttp.responseText;
document.getElementById(loader).style.visibility= 'hidden';
} 
}
}

//........................................................
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
//grade filter function.................................

function gradefilter(stnum)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var loader="ldr2"+stnum;
document.getElementById(loader).src='./images/ajax-loader.gif';
document.getElementById(loader).style.visibility= 'visible';


var grad=stnum+"grade";
var a = document.getElementById(grad);
var rgrade = a.options[a.selectedIndex].value;

var result="result2"+stnum;


var url="./Ajax/result_filt.php";
url=url+"?task=grdfilt"+"&stnum="+stnum+"&rgrade="+rgrade;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);



function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(result).innerHTML=xmlHttp.responseText;
document.getElementById(loader).style.visibility= 'hidden';
} 
}
}
//..................................................................
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////




//...................................................................
//common statement//////
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




