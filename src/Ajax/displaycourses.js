var xmlHttp;



function displayCourses()
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loader6").style.visibility= 'visible';
var url="Ajax/display_courses.php";
var dept=document.getElementById('dept_subject').value;
url=url+"?dept="+dept;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById('courseunit').innerHTML=xmlHttp.responseText;
document.getElementById("loader6").style.visibility= 'hidden';

} 
}
}







function displayLid()
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loader7").style.visibility= 'visible';
var url="Ajax/display_lid.php";
var date=document.getElementById('date2').value;
var dept_courses1=document.getElementById('dept_courses').value;
url=url+"?course="+dept_courses1+"&date="+date;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById('lid').innerHTML=xmlHttp.responseText;
document.getElementById("loader7").style.visibility= 'hidden';

} 
}
}






function displaystd()
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
document.getElementById("loader8").style.visibility= 'visible';
var url="Ajax/display_std.php";
var lecture_id_select=document.getElementById('lecture_id').value;
var dept_courses1=document.getElementById('dept_courses').value;
url=url+"?course5="+dept_courses1+"&lid="+lecture_id_select;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById('std').innerHTML=xmlHttp.responseText;
document.getElementById("loader8").style.visibility= 'hidden';

} 
}
}





function medical(std,lid)
{ 



xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
var image=std+"-img";
var div=std+"-div";

document.getElementById(image).style.visibility= 'visible';
var url="Ajax/medical.php";
url=url+"?student="+std+"&lid="+lid;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(div).innerHTML=xmlHttp.responseText;
document.getElementById(image).style.visibility= 'hidden';

} 
}

}











function removethis(std,lid)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

var image=std+"-img";

var div=std+"-div";

document.getElementById(image).style.visibility= 'visible';
var url="Ajax/removemed.php";

url=url+"?std="+std+"&lid="+lid;


xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(div).innerHTML=xmlHttp.responseText;
document.getElementById(image).style.visibility= 'hidden';

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

