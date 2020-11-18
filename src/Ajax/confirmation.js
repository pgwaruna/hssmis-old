//..........display confirmation of course unit according to registration table.......................
var xmlHttp;

function change(course, student)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
 
var url="../Ajax/confirmation.php";
url=url+"?course="+course+"&student="+student;
var imgid=course+"img"+student;
document.getElementById(imgid).src='../images/ajax-loader.gif';
var divid=course+"-"+student;

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
//.................edit by Iranga...............
//......... add new co course unit, to registration table .........................
function changeAdd(course, student)
{ 
var where_to= confirm("Do you really want add this COURSE UNIT.?....if yes, Click  [OK]...");
 if (where_to== true)
 {
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	 {
	 alert ("Browser does not support HTTP Request");
	 return;
	 }
	 
	var url="../Ajax/confirmation.php";
	url=url+"?course="+course+"&student="+student+"&addnew=yes"+"&core=1";
	var imgid=course+"img"+student;
	document.getElementById(imgid).src='../images/ajax-loader.gif';
	var divid=course+"-"+student;

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
//.................edit by Iranga...............
//......... add new op course unit, to registration table .........................
function changeAddOptional(course, student)
{ 
var where_to= confirm("Do you really want add this  COURSE UNIT.?....if yes, Click  [OK]...");
 if (where_to== true)
 {
	
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	 {
	 alert ("Browser does not support HTTP Request");
	 return;
	 }
	 
	var url="../Ajax/confirmation.php";
	
	var cored=prompt("If this course unit as a DEGREE Enter- '1' .... as a NON DEGREE Enter- '2' ","--Enter Number--  DEGREE -1- NON DEGREE -2-");
	if(cored=="1" || cored=="2")
	{
		url=url+"?course="+course+"&student="+student+"&addnew=yes"+"&core="+cored;
	
		var imgid=course+"img"+student;
		document.getElementById(imgid).src='../images/ajax-loader.gif';
		var divid=course+"-"+student;

		xmlHttp.onreadystatechange=stateChanged;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	else
	{
		alert("Your number should be 1 or 2");
	}
	
 }
 
function stateChanged() 
	{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	document.getElementById(divid).innerHTML=xmlHttp.responseText;
	//document.getElementById(imgid).style.visibility= 'hidden';
	} 
	}


//...........................

}



//....................remove corse unit...................



function removecu(course, student)
{ 
var removecnf= confirm("Do you really want remove this COURSE UNIT.?....if yes, Click  [OK]...");
 if (removecnf== true)
 {


xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
 
var url="../Ajax/confirmation.php";
url=url+"?course="+course+"&student="+student+"&task=remove";
var imgid="rm"+course+"img"+student;
document.getElementById(imgid).src='../images/ajax-loader.gif';
var divid="rm"+course+"-"+student;

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
	}


function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById(divid).innerHTML=xmlHttp.responseText;
document.getElementById(imgid).style.visibility= 'hidden';
} 
}
	
}

//..........................................
















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

